<?php

namespace WBB\CoreBundle\RedirectUrl;

use Ddeboer\DataImport\Reader\CsvReader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator;
use WBB\CoreBundle\Entity\RedirectUrl;

class UrlImporter
{

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct(ObjectManager $em, Validator $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function import(UploadedFile $file)
    {
        $path = $file->getPath() . '/' . $file->getFilename();
        $reader = new CsvReader(new \SplFileObject($path));
        $nb = 0;

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '1024M');

        $reader->setHeaderRowNumber(0);
        foreach ($reader as $data) {
            $url = new RedirectUrl();
            $url->setDestination($data['Destination']);
            $url->setSource($data['From']);
            $url->setRedirect($data['Redirect']);

            $errors = $this->validator->validate($url);
            if (count($errors) > 0) {
                //echo 'Not valid ! ';
            } else {
                $this->em->persist($url);
            }
            if ($nb % 100 == 0) {
                $this->em->flush();
                $this->em->clear();
            }
            $nb++;
        }

        $this->em->flush();
    }

}
