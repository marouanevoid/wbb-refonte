<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Ddeboer\DataImport\Reader\CsvReader;
use Symfony\Component\HttpFoundation\StreamedResponse;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\BarOpening;
use WBB\BarBundle\Entity\Collections\BarTag;
use WBB\BarBundle\Entity\Semsoft\SemsoftBar;
use WBB\BarBundle\Entity\Tag;
use WBB\CoreBundle\Entity\City;
use WBB\CoreBundle\Entity\CitySuburb;
use WBB\BarBundle\Form\SemsoftType;
use WBB\BarBundle\Form\TipType;
use WBB\BarBundle\Entity\Tip;

class SemsoftController extends Controller
{
    public function previewAction($ssBarId)
    {
        $ssBar = $this->getDoctrine()->getRepository('WBBBarBundle:Semsoft\SemsoftBar')->findOneById($ssBarId);
        $bar = $ssBar->getUpdatedBar();

        $user = $this->container->get('user.repository')->findOneById(1);

        $tip = new Tip();
        $tip
            ->setUser($user)
            ->setBar($bar)
            ->setStatus(1);

        $form = $this->createForm(new TipType(), $tip, array('em' => $this->container->get('doctrine.orm.entity_manager')));

        return $this->render('WBBBarBundle:Bar:details.html.twig', array(
            'bar'       => $bar,
            'barLike'   => array(),
            'oneCity'   => true,
            'tipForm'   => $form->createView()
        ));
    }

    public function mergeAction($ssBarId)
    {
        $em = $this->getDoctrine()->getManager();

        $ssBar = $this->getDoctrine()->getRepository('WBBBarBundle:Semsoft\SemsoftBar')->findOneById($ssBarId);
        $bar = $ssBar->getUpdatedBar();

        $em->persist($bar);
        $em->remove($ssBar);
        $em->flush();

        return new RedirectResponse($this->generateUrl("admin_wbb_bar_semsoft_semsoftbar_list"));
    }

    public function importFormAction()
    {
        $form = $this->createImportForm();

        return $this->render('WBBBarBundle:Block:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function importAction(Request $request)
    {
        $form = $this->createImportForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $form->getData();

            $file['file']->move('upload', 'import.csv');
            $file = new \SplFileObject($this->container->getParameter('kernel.root_dir').'/../web/upload/import.csv');
            $reader = new CsvReader($file, ';');

            $reader->setHeaderRowNumber(0);
            foreach ($reader as $data)
            {
                $ssBar = new SemsoftBar();
                $bar = null;
                $newBar = true;

                if($data['ID'] && is_numeric($data['ID'])){
                    $bar = $this->get('bar.repository')->findOneById($data['ID']);

                    if($bar){
                        $ssBar->hydrateByBar($bar);
                        $newBar = false;
                    }
                }
                $country = $this->getCountry($data['Country']);
                if($country && ($bar || !empty($data['Name']))){

                    $city   = $this->getCity($data['City'], $country);
                    if(!$city){
                        $city = new City();
                        $city
                            ->setName($data['City'])
                            ->setCountry($country)
                            ->setPostalCode($data['PostalCode'])
                        ;
                        $em->persist($city);
                        $em->flush();
                    }
                    $suburb = $this->getSuburb($data['District'], $city);
                    $ssBar->setCity($this->setFieldValue('City', $data, $city, $newBar));
                    $ssBar->setSuburb($this->setFieldValue('District', $data, $suburb, $newBar));
                    $ssBar->setCountry($this->setFieldValue('Country', $data, $country, $newBar));
                    $ssBar->setName($this->setFieldValue('Name', $data, null, $newBar));
                    $ssBar->setCounty($this->setFieldValue('County', $data, null, $newBar));
                    $ssBar->setPostalCode($this->setFieldValue('PostalCode', $data, null, $newBar));
                    $ssBar->setAddress($this->setFieldValue('Street1', $data, ($data['Street1'].' '.$data['Street2']), $newBar));
                    $ssBar->setSeoDescription($this->setFieldValue('Intro', $data, null, $newBar));
                    $ssBar->setDescription($this->setFieldValue('Description', $data, null, $newBar));
                    $ssBar->setLatitude($this->setFieldValue('GeocoordinateString', $data, $this->splitGeoData($data['GeocoordinateString']), $newBar));
                    $ssBar->setLongitude($this->setFieldValue('GeocoordinateString', $data, $this->splitGeoData($data['GeocoordinateString'], false), $newBar));
                    $ssBar->setWebsite($this->setFieldValue('Website', $data, null, $newBar));
                    $ssBar->setEmail($this->setFieldValue('Email', $data, null, $newBar));
                    $ssBar->setPhone($this->setFieldValue('Phone', $data, null, $newBar));
                    $ssBar->setOutDoorSeating($this->setFieldValue('OutdoorSeating', $data, (($data['OutdoorSeating'] == "true")?true:false), $newBar));
                    $ssBar->setHappyHour($this->setFieldValue('HappyHour', $data, (($data['HappyHour'] == "true")?true:false), $newBar));
                    $ssBar->setWifi($this->setFieldValue('Wifi', $data, (($data['Wifi'] == "true")?true:false), $newBar));
                    $ssBar->setPrice($this->setFieldValue('PriceRange', $data, $this->getPriceValue($data['PriceRange']), $newBar));
                    $ssBar->setCreditCard($this->setFieldValue('PaymentAccepted', $data, $this->isCreditCard($data['PaymentAccepted']), $newBar));
                    $ssBar->setMenu($this->setFieldValue('MenuUrl', $data, null, $newBar));
                    $ssBar->setReservation($this->setFieldValue('Booking', $data, null, $newBar));
                    $ssBar->setParkingType($this->setFieldValue('ParkingType', $data, null, $newBar));
                    //Public Transport
                    $ssBar->setFacebookID($this->setFieldValue('FacebookId', $data, null, $newBar));
                    $ssBar->setFacebookUserPage($this->setFieldValue('FacebookUserPage', $data, null, $newBar));
                    $ssBar->setFacebookCheckIns($this->setFieldValue('FacebookCheckins', $data, null, $newBar));
                    $ssBar->setFacebookLikes($this->setFieldValue('FacebookLikes', $data, null, $newBar));
                    $ssBar->setFoursquareID($this->setFieldValue('FoursquareId', $data, null, $newBar));
                    $ssBar->setFoursquareUserPage($this->setFieldValue('FoursquareUserPage', $data, null, $newBar));
                    $ssBar->setFoursquareCheckIns($this->setFieldValue('FoursquareCheckIns', $data, null, $newBar));
                    $ssBar->setFoursquareLikes($this->setFieldValue('FoursquareLikes', $data, null, $newBar));
                    $ssBar->setFoursquareTips($this->setFieldValue('FoursquareTips', $data, null, $newBar));
                    $ssBar->setTwitterName($this->setFieldValue('TwitterName', $data, null, $newBar));
                    $ssBar->setTwitterUserPage($this->setFieldValue('TwitterUserPage', $data, null, $newBar));
                    $ssBar->setInstagramID($this->setFieldValue('InstagramId', $data, null, $newBar));
                    $ssBar->setInstagramUserPage($this->setFieldValue('InstagramUserPage', $data, null, $newBar));
                    $ssBar->setGooglePlusUserPage($this->setFieldValue('GooglePlusUserPage', $data, null, $newBar));
                    $ssBar->setPermanentlyClosed($this->setFieldValue('IsPermanentlyClosed', $data, null, $newBar));
                    $ssBar->setBusinessFound($this->setFieldValue('BusinessFound', $data, null, $newBar));
                    $ssBar->setUpdatedColumns($this->strToArray($data['Updated Columns']));
                    $ssBar->setOverwrittenColumns($this->strToArray($data['Overwritten Columns']));

                    //Tags
                    $this->getTagsFromString($data['Category'], Tag::WBB_TAG_TYPE_THEME, $ssBar);
                    $this->getTagsFromString($data['Mood'], Tag::WBB_TAG_TYPE_ENERGY_LEVEL, $ssBar);
                    $this->getTagsFromString($data['RestaurantServices'], Tag::WBB_TAG_TYPE_SPECIAL_FEATURES, $ssBar);

                    //Open hours
                    $ssBar = $this->getOpenHoursArray($data['MondayOpenHours'], 1, $ssBar);
                    $ssBar = $this->getOpenHoursArray($data['TuesdayOpenHours'], 2, $ssBar);
                    $ssBar = $this->getOpenHoursArray($data['WednesdayOpenHours'], 3, $ssBar);
                    $ssBar = $this->getOpenHoursArray($data['ThursdayOpenHours'], 4, $ssBar);
                    $ssBar = $this->getOpenHoursArray($data['FridayOpenHours'], 5, $ssBar);
                    $ssBar = $this->getOpenHoursArray($data['SaturdayOpenHours'], 6, $ssBar);
                    $ssBar = $this->getOpenHoursArray($data['SundayOpenHours'], 7, $ssBar);

                    $em->persist($ssBar);
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_wbb_bar_semsoft_semsoftbar_list'));
        }

        return $this->render('WBBBarBundle:Block:empty_block.html.twig');
    }

    public function exportAction()
    {
        $container = $this->container;
        $response = new StreamedResponse(function() use($container) {

            $em = $container->get('doctrine')->getManager();
            $results = $em->getRepository('WBBBarBundle:Bar')->getExportQuery()->iterate();
            $handle = fopen('php://output', 'r+');

            fputcsv($handle, array(
                'ID', 'Name', 'Country', 'County', 'City', 'PostalCode', 'District', 'Street1', 'Street2',
                'Intro', 'Description', 'GeocoordinateString', 'Website', 'Email', 'Phone', 'MondayOpenHours',
                'TuesdayOpenHours', 'WednesdayOpenHours', 'ThursdayOpenHours', 'FridayOpenHours', 'SaturdayOpenHours',
                'SundayOpenHours', 'Category', 'Mood', 'OutdoorSeating', 'HappyHour', 'Wifi', 'PriceRange', 'PaymentAccepted',
                'RestaurantServices', 'MenuUrl', 'Booking', 'ParkingType', 'PublicTransport', 'FacebookId', 'FacebookUserPage',
                'TwitterName', 'TwitterUserPage', 'InstagramId', 'InstagramUserPage', 'GooglePlusUserPage', 'FoursquareId',
                'FoursquareUserPage', 'FacebookLikes', 'FacebookCheckins', 'FoursquareLikes', 'FoursquareCheckIns',
                'FoursquareTips', 'IsPermanentlyClosed', 'BusinessFound', 'Updated Columns', 'Overwritten Columns'
            ), ',');

            while (false !== ($row = $results->next())) {
                fputcsv($handle, $row[0]->toCSVArray(), ',');
                $em->detach($row[0]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-Disposition','attachment; filename="export.csv"');

        return $response;
    }

    private function setFieldValue($fieldName, $data, $value = null, $forceUpdate = false)
    {
        if($forceUpdate)
        {
            if($value != null)
                return $value;
            else
                return $data[$fieldName];
        }else{
            if (in_array($fieldName, $this->strToArray($data['Updated Columns'])) || in_array($fieldName, $this->strToArray($data['Overwritten Columns']))) {
                if($value != null)
                    return $value;
                else
                    return $data[$fieldName];
            }
            else{
                return null;
            }
        }
    }

    private function createImportForm()
    {
        $form = $this->createForm(new SemsoftType(), array(), array(
            'action' => $this->generateUrl('wbb_semsoft_import'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Import'));

        return $form;
    }

    private function splitGeoData($data, $latitude = true)
    {
        $coordinates = explode(",", $data);

        if(count($coordinates) == 2){
            if($latitude)
                return $coordinates[0];
            else
                return $coordinates[1];
        }else
        {
            return null;
        }
    }

    private function getPriceValue($price)
    {
        if(strlen($price) && str_replace('$','',$price)=="")
            return strlen($price);
        else
            return null;
    }

    private function isCreditCard($methodsString)
    {
        $cards = array('cash','mastercard','visa','amex','discover');

        $methods = explode(',', $methodsString);

        foreach($methods as $method)
        {
            if(in_array($method, $cards))
            {
                return true;
            }
        }

        return false;
    }

    private function getCountry($countryAcronym)
    {
        return ($countryAcronym)?$this->container->get('country.repository')->findOneByAcronym($countryAcronym) : null;
    }

    private function getCity($cityName, $country)
    {
        return ($cityName)?$this->container->get('city.repository')->findByNameAndCountry($cityName, $country) : null;
    }

    private function getSuburb($suburbName, $city)
    {
        if(empty($suburbName)){
            $suburbName = 'Unspecified';
        }

        $em = $this->getDoctrine()->getManager();
        $suburb = $this->container->get('suburb.repository')->findByNameAndCity($suburbName, $city);

        if(!$suburb)
        {
            $suburb = new CitySuburb();
            $suburb
                ->setName($suburbName)
                ->setCity($city);
            $em->persist($suburb);
            $em->flush();
        }


        return $suburb;
    }

    private function getOpenHoursArray($openHoursString, $day, SemsoftBar $ssBar)
    {
        $hourRanges = explode(',', $openHoursString);

        foreach($hourRanges as $hourRange)
        {
            $hours = explode('-', $hourRange);
            if(count($hours) == 2){
                $fromHour   = explode(':', $hours[0]);
                $toHour     = explode(':', $hours[1]);

                $opening = new BarOpening();
                $opening
                    ->setOpeningDay($day)
                    ->setFromHour($fromHour[0])
                    ->setToHour($toHour[0])
                    ->setSemsoftBar($ssBar);

                $ssBar->addOpening($opening);
            }
        }

        return $ssBar;
    }

    private function strToArray($string)
    {
        $string = str_replace('[', '', $string);
        $string = str_replace(']', '', $string);

        return explode(',', $string);
    }

    private function getTagsFromString($tags, $type, SemsoftBar $ssBar)
    {
        $em = $this->getDoctrine()->getManager();
        $tagNames = explode(',', $tags);
        if($tagNames){
            foreach($tagNames as $tagName){
                $tag = $this->get('tag.repository')->findOneByName($tagName);
                if(!$tag){
                    $tag = new Tag();
                    $tag
                        ->setName($tagName)
                        ->setType($type);
                }
                $em->persist($tag);
                $em->flush();

                if($type == Tag::WBB_TAG_TYPE_ENERGY_LEVEL){
                    $ssBar->setEnergyLevel($tag);
                }elseif($type == Tag::WBB_TAG_TYPE_THEME || $type == Tag::WBB_TAG_TYPE_SPECIAL_FEATURES){
                    $barTag = new BarTag();
                    $barTag
                        ->setType($type)
                        ->setSemsoftBar($ssBar)
                        ->setTag($tag);
                    $ssBar->addTag($barTag);
                    $tag->addBar($barTag);
                    $em->persist($barTag);
                    $em->persist($ssBar);
                    $em->flush();
                }
            }
        }
    }
}