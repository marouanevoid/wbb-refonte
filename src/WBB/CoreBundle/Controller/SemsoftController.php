<?php

namespace WBB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ddeboer\DataImport\Reader\CsvReader;
//use Ddeboer\DataImport\Source\StreamSource;
use Ddeboer\DataImportWorkflow;
use Ddeboer\DataImport\Writer\DoctrineWriter;
use WBB\BarBundle\Entity\BarOpening;
use WBB\BarBundle\Entity\Semsoft\SemsoftBar;
use WBB\CoreBundle\Entity\CitySuburb;
use WBB\CoreBundle\Form\SemsoftType;

class SemsoftController extends Controller
{

    public function importFormAction()
    {
        $form = $this->createImportForm();

        return $this->render('WBBCoreBundle:Block:form.html.twig', array(
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


                $country    = $this->getCountry($data['Country']);
                if($country){
                    $city       = $this->getCity($data['City'], $country);
                    $suburb     = $this->getSuburb($data['District'], $city);

                    $ssBar->setCountry($country);
                    $ssBar->setCity($city);
                    $ssBar->setSuburb($suburb);
                }

                $ssBar->setName($data['Name']);
                $ssBar->setCounty($data['County']);
                $ssBar->setPostalCode($data['PostalCode']);
                $ssBar->setAddress($data['Street1'].' '.$data['Street2']);
                $ssBar->setSeoDescription($data['Intro']);
                $ssBar->setDescription($data['Description']);
                $ssBar->setLatitude($this->splitGeoData($data['GeocoordinateString']));
                $ssBar->setLongitude($this->splitGeoData($data['GeocoordinateString'], false));
                $ssBar->setWebsite($data['Website']);
                $ssBar->setEmail($data['Email']);
                $ssBar->setPhone($data['Phone']);
                //Tags (Category, Mood)
                $ssBar->setIsOutDoorSeating(($data['OutdoorSeating'] == "true")?true:false);
                $ssBar->setIsHappyHour(($data['HappyHour'] == "true")?true:false);
                $ssBar->setIsWiFi(($data['Wifi'] == "true")?true:false);
                $ssBar->setPrice($this->getPriceValue($data['PriceRange']));
                $ssBar->setIsCreditCard($this->isCreditCard($data['PaymentAccepted']));
                //RestaurantServices
                $ssBar->setMenu($data['MenuUrl']);
                $ssBar->setReservation($data['Booking']);
                $ssBar->setParkingType($data['ParkingType']);
                //Public Transport
                $ssBar->setFacebookID($data['FacebookId']);
                $ssBar->setFacebookUserPage($data['FacebookUserPage']);
                $ssBar->setFacebookCheckIns($data['FacebookCheckins']);
                $ssBar->setFacebookLikes($data['FacebookLikes']);
                $ssBar->setFoursquareID($data['FoursquareId']);
                $ssBar->setFoursquareUserPage($data['FoursquareUserPage']);
                $ssBar->setFoursquareCheckIns($data['FoursquareCheckIns']);
                $ssBar->setFoursquareLikes($data['FoursquareLikes']);
                $ssBar->setFoursquareTips($data['FoursquareTips']);
                $ssBar->setTwitterName($data['TwitterName']);
                $ssBar->setTwitterUserPage($data['TwitterUserPage']);
                $ssBar->setInstagramID($data['InstagramId']);
                $ssBar->setInstagramUserPage($data['InstagramUserPage']);
                $ssBar->setGooglePlusUserPage($data['GooglePlusUserPage']);
                $ssBar->setIsPermanentlyClosed($data['IsPermanentlyClosed']);
                $ssBar->setBusinessFound($data['BusinessFound']);
                $ssBar->setUpdatedColumns($data['Updated Columns']);
                $ssBar->setOverwrittenColumns($data['Overwritten Columns']);

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

            $em->flush();

            return $this->redirect($this->generateUrl('admin_wbb_bar_semsoft_semsoftbar_list'));
        }

        return $this->render('WBBCoreBundle:Block:empty_block.html.twig');
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

}