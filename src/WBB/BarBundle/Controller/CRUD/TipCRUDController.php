<?php

namespace WBB\BarBundle\Controller\CRUD;

use Sonata\AdminBundle\Controller\CRUDController as Controller,
    Sonata\AdminBundle\Datagrid\ProxyQueryInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TipCRUDController extends Controller
{
    protected function batchActionEnabled(ProxyQueryInterface $selectedTipsQuery)
    {
        if (!$this->admin->isGranted('EDIT') || !$this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }
        $modelManager = $this->admin->getModelManager();

        $tips = $selectedTipsQuery->execute();

        // the enabling process works here
        try {
            foreach ($tips as $tip) {
                $tip->setStatus(1);
                $modelManager->update($tip);
            }

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'flash_batch_enabled_error');

            return new RedirectResponse(
                $this->admin->generateUrl('list',$this->admin->getFilterParameters())
            );
        }

        $this->addFlash('sonata_flash_success', 'flash_batch_enabled_success');

        return new RedirectResponse(
            $this->admin->generateUrl('list',$this->admin->getFilterParameters())
        );
    }

    protected function batchActionDisabled(ProxyQueryInterface $selectedTipsQuery)
    {
        if (!$this->admin->isGranted('EDIT') || !$this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }
        $modelManager = $this->admin->getModelManager();

        $tips = $selectedTipsQuery->execute();

        // the enabling process works here
        try {
            foreach ($tips as $tip) {
                $tip->setStatus(2);
                $modelManager->update($tip);
            }

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'flash_batch_enabled_error');

            return new RedirectResponse(
                $this->admin->generateUrl('list',$this->admin->getFilterParameters())
            );
        }

        $this->addFlash('sonata_flash_success', 'flash_batch_enabled_success');

        return new RedirectResponse(
            $this->admin->generateUrl('list',$this->admin->getFilterParameters())
        );
    }

    protected function batchActionPending(ProxyQueryInterface $selectedTipsQuery)
    {
        if (!$this->admin->isGranted('EDIT') || !$this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }
        $modelManager = $this->admin->getModelManager();

        $tips = $selectedTipsQuery->execute();

        // the enabling process works here
        try {
            foreach ($tips as $tip) {
                $tip->setStatus(0);
                $modelManager->update($tip);
            }

        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', 'flash_batch_enabled_error');

            return new RedirectResponse(
                $this->admin->generateUrl('list',$this->admin->getFilterParameters())
            );
        }

        $this->addFlash('sonata_flash_success', 'flash_batch_enabled_success');

        return new RedirectResponse(
            $this->admin->generateUrl('list',$this->admin->getFilterParameters())
        );
    }
}
