<?php

namespace WBB\BarBundle\Controller\CRUD;

use Sonata\AdminBundle\Controller\CRUDController as Controller,
    Sonata\AdminBundle\Datagrid\ProxyQueryInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
        $allMerged = true;

        // the merge process works here
        try {
            foreach ($ssBars as $ssBar) {
                $bar = $ssBar->getUpdatedBar();
                if($bar->getCity() and $bar->getSuburb())
                {
                    $modelManager->update($bar);
                    $modelManager->delete($ssBar);
                }else{
                    $allMerged = false;
                }
            }

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'Errors during merge !');

            return new RedirectResponse(
                $this->admin->generateUrl('list',$this->admin->getFilterParameters())
            );
        }

        if($allMerged){
            $this->addFlash('sonata_flash_success', 'Merge Successful !');
        }else{
            $this->addFlash('sonata_flash_error', 'Merge incomplete : City or suburb missing from some bars!');
        }

        return new RedirectResponse(
            $this->admin->generateUrl('list',$this->admin->getFilterParameters())
        );
    }
}