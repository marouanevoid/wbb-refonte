<?php

namespace WBB\BarBundle\Controller\CRUD;

use Sonata\AdminBundle\Controller\CRUDController as Controller,
    Sonata\AdminBundle\Datagrid\ProxyQueryInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SemsoftCRUDController extends Controller
{
    protected function batchActionMerge(ProxyQueryInterface $selected)
    {
        if (!$this->admin->isGranted('EDIT') || !$this->admin->isGranted('DELETE'))
        {
            throw new AccessDeniedException();
        }
        $modelManager = $this->admin->getModelManager();

        $ssBars = $selected->execute();

        // the merge process works here
        try {
            foreach ($ssBars as $ssBar) {
                $bar = $ssBar->getUpdatedBar();
                $modelManager->update($bar);
                $modelManager->delete($ssBar);
            }

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'Errors during merge !');

            return new RedirectResponse(
                $this->admin->generateUrl('list',$this->admin->getFilterParameters())
            );
        }

        $this->addFlash('sonata_flash_success', 'Merge Successful !');

        return new RedirectResponse(
            $this->admin->generateUrl('list',$this->admin->getFilterParameters())
        );
    }

    protected function batchActionExport(ProxyQueryInterface $selected)
    {
        if (!$this->admin->isGranted('EDIT') || !$this->admin->isGranted('DELETE'))
        {
            throw new AccessDeniedException();
        }

        $bars = $selected->execute();

        // the export process works here
        try {
            $response = new StreamedResponse(function() use($bars) {

                $handle = fopen('php://output', 'r+');

                fputcsv($handle, array(
                    'Id', 'Name', 'Country', 'County', 'City', 'PostalCode', 'District', 'Street1', 'Street2',
                    'Intro', 'Description', 'GeocoordinateString', 'Website', 'Email', 'Phone', 'MondayOpenHours',
                    'TuesdayOpenHours', 'WednesdayOpenHours', 'ThursdayOpenHours', 'FridayOpenHours', 'SaturdayOpenHours',
                    'SundayOpenHours', 'Category', 'Mood', 'OutdoorSeating', 'HappyHour', 'Wifi', 'PriceRange', 'PaymentAccepted',
                    'RestaurantServices', 'MenuUrl', 'Booking', 'ParkingType', 'PublicTransport', 'FacebookId', 'FacebookUserPage',
                    'TwitterName', 'TwitterUserPage', 'InstagramId', 'InstagramUserPage', 'GooglePlusUserPage', 'FoursquareId',
                    'FoursquareUserPage', 'FacebookLikes', 'FacebookCheckins', 'FoursquareLikes', 'FoursquareCheckIns',
                    'FoursquareTips', 'IsPermanentlyClosed', 'BusinessFound', 'Updated Columns', 'Overwritten Columns'
                ), ',');

                foreach ($bars as $bar) {
                    fputcsv($handle, $bar->toCSVArray(), ',');
                }

                fclose($handle);
            });

            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-Disposition','attachment; filename="export.csv"');

            return $response;

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'Errors during merge !');

            return new RedirectResponse(
                $this->admin->generateUrl('list',$this->admin->getFilterParameters())
            );
        }
    }
}