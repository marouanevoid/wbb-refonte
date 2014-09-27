<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CountryController extends Controller
{

    public function importAction(Request $request)
    {
        $form = $this->getImportForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $file = $data['file'];

            if ($file instanceof UploadedFile) {
                $legalAgeImporter = $this->get('wbb.legal_age.importer');
                $error = $legalAgeImporter->import($file);
                if ($error) {
                    $this->get('session')->getFlashBag()->add('sonata_flash_success', 'Some countries legal ages have been imported, check the log file for errors.');
                } else {
                    $this->get('session')->getFlashBag()->add('sonata_flash_success', 'Countris legal ages successfully imported');
                }

                return new RedirectResponse($this->get('router')->generate('sonata_admin_homepage'));
            }
        }

        $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Errors during import : File not valid !');

        return new RedirectResponse($this->get('router')->generate('sonata_admin_homepage'));
    }

    public function formAction()
    {
        $form = $this->getImportForm();

        return $this->render('WBBBarBundle:Block:form.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    private function getImportForm()
    {
        $builder = $this->createFormBuilder()
                ->setAction($this->generateUrl('wbb_import_legal_age'))
                ->setMethod('POST')
                ->add('file', 'file')
                ->add('submit', 'submit', array('label' => 'Import'))
        ;

        return $builder->getForm();
    }

}
