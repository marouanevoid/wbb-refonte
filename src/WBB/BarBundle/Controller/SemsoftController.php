<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ddeboer\DataImport\Reader\CsvReader;
use Ddeboer\DataImportWorkflow;
use Ddeboer\DataImport\Writer\DoctrineWriter;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\BarOpening;
use WBB\BarBundle\Entity\Semsoft\SemsoftBar;
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

    public function mergeAction()
    {
        // TODO: After tags edited
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

                if($data['ID'] and is_numeric($data['ID'])){
                    $bar = $this->get('bar.repository')->findOneById($data['ID']);
                    
                    if($bar){
                        $ssBar->hydrateByBar($bar);
                    }elseif($data['Name'] and !empty($data['Name'])){

                        $country    = $this->getCountry($data['Country']);
                        if($country){
                            $city   = $this->getCity($data['City'], $country);
                            if($city)
                            {
                                $suburb = $this->getSuburb($data['District'], $city);
                                $ssBar->setCity($this->setFieldValue('City', $data, $city));
                                $ssBar->setSuburb($this->setFieldValue('District', $data, $suburb));
                            }
                            $ssBar->setCountry($this->setFieldValue('Country', $data, $country));
                        }

                        $ssBar->setName($this->setFieldValue('Name', $data));
                        $ssBar->setCounty($this->setFieldValue('County', $data));
                        $ssBar->setPostalCode($this->setFieldValue('PostalCode', $data));
                        $ssBar->setAddress($this->setFieldValue('Name', $data, ($data['Street1'].' '.$data['Street2'])));
                        $ssBar->setSeoDescription($this->setFieldValue('Intro', $data));
                        $ssBar->setDescription($this->setFieldValue('Description', $data));
                        $ssBar->setLatitude($this->setFieldValue('GeocoordinateString', $data, $this->splitGeoData($data['GeocoordinateString'])));
                        $ssBar->setLongitude($this->setFieldValue('GeocoordinateString', $data, $this->splitGeoData($data['GeocoordinateString'], false)));
                        $ssBar->setWebsite($this->setFieldValue('Website', $data));
                        $ssBar->setEmail($this->setFieldValue('Email', $data));
                        $ssBar->setPhone($this->setFieldValue('Phone', $data));
                        //Tags (Category, Mood)
                        $ssBar->setIsOutDoorSeating($this->setFieldValue('OutdoorSeating', $data, ($data['OutdoorSeating'] == "true")?true:false));
                        $ssBar->setIsHappyHour($this->setFieldValue('HappyHour', $data, ($data['HappyHour'] == "true")?true:false));
                        $ssBar->setIsWiFi($this->setFieldValue('Wifi', $data, ($data['Wifi'] == "true")?true:false));
                        $ssBar->setPrice($this->setFieldValue('PriceRange', $data, $this->getPriceValue($data['PriceRange'])));
                        $ssBar->setIsCreditCard($this->setFieldValue('PaymentAccepted', $data, $this->isCreditCard($data['PaymentAccepted'])));
                        //RestaurantServices
                        $ssBar->setMenu($this->setFieldValue('MenuUrl', $data));
                        $ssBar->setReservation($this->setFieldValue('Booking', $data));
                        $ssBar->setParkingType($this->setFieldValue('ParkingType', $data));
                        //Public Transport
                        $ssBar->setFacebookID($this->setFieldValue('FacebookId', $data));
                        $ssBar->setFacebookUserPage($this->setFieldValue('FacebookUserPage', $data));
                        $ssBar->setFacebookCheckIns($this->setFieldValue('FacebookCheckins', $data));
                        $ssBar->setFacebookLikes($this->setFieldValue('FacebookLikes', $data));
                        $ssBar->setFoursquareID($this->setFieldValue('FoursquareId', $data));
                        $ssBar->setFoursquareUserPage($this->setFieldValue('FoursquareUserPage', $data));
                        $ssBar->setFoursquareCheckIns($this->setFieldValue('FoursquareCheckIns', $data));
                        $ssBar->setFoursquareLikes($this->setFieldValue('FoursquareLikes', $data));
                        $ssBar->setFoursquareTips($this->setFieldValue('FoursquareTips', $data));
                        $ssBar->setTwitterName($this->setFieldValue('TwitterName', $data));
                        $ssBar->setTwitterUserPage($this->setFieldValue('TwitterUserPage', $data));
                        $ssBar->setInstagramID($this->setFieldValue('InstagramId', $data));
                        $ssBar->setInstagramUserPage($this->setFieldValue('InstagramUserPage', $data));
                        $ssBar->setGooglePlusUserPage($this->setFieldValue('GooglePlusUserPage', $data));
                        $ssBar->setIsPermanentlyClosed($this->setFieldValue('IsPermanentlyClosed', $data));
                        $ssBar->setBusinessFound($this->setFieldValue('BusinessFound', $data));
                        $ssBar->setUpdatedColumns($this->strToArray($data['Updated Columns']));
                        $ssBar->setOverwrittenColumns($this->strToArray($data['Overwritten Columns']));

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
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_wbb_bar_semsoft_semsoftbar_list'));
        }

        return $this->render('WBBBarBundle:Block:empty_block.html.twig');
    }

    private function setFieldValue($fieldName, $data, $value = null)
    {
        if (in_array($fieldName, $this->strToArray($data['Updated Columns'])) or in_array($fieldName, $this->strToArray($data['Overwritten Columns']))) {
            if($value != null)
                return $value;
            else
                return $data[$fieldName];
        }
        else{
            return null;
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
        if(strlen($price) and str_replace('$','',$price)=="")
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
        $suburb = $this->container->get('suburb.repository')->findByNameAndCity($suburbName, $city);

        if(!$suburb)
        {
            $suburb = new CitySuburb();
            $suburb
                ->setName($suburbName)
                ->setCity($city);
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
}