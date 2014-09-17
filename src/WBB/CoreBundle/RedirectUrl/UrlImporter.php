<?php

namespace WBB\CoreBundle\RedirectUrl;

use Ddeboer\DataImport\Reader\CsvReader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator;
use WBB\CoreBundle\Entity\RedirectUrl;
use WBB\CoreBundle\RedirectUrl\Logger;

class UrlImporter
{

    const BATCH_SIZE = 250;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(ObjectManager $em, Validator $validator, Logger $logger)
    {
        $this->em = $em;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    public function import(UploadedFile $file)
    {
        $path = $file->getPath() . '/' . $file->getFilename();
        $reader = new CsvReader(new \SplFileObject($path));
        $importError = false;

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '1024M');

        $nb = 0;
        $toFlush = array();

        $reader->setHeaderRowNumber(0);
        foreach ($reader as $data) {
            $url = new RedirectUrl();
            $url->setDestination($data['Destination']);
            $url->setSource($data['From']);
            $url->setRedirect($data['Redirect']);

            $errors = $this->validator->validate($url);
            if (count($errors) > 0) {
                $importError = true;
                $errorMessagesArray = array();
                foreach ($errors as $error) {
                    $errorMessagesArray[] = $error->getMessage();
                }
                $this->logger->error('The source URL "' . $url->getSource() . '" (line ' . $nb . ') could not be imported. Error messages : ' . implode(',', $errorMessagesArray));
            } else {
                if (!in_array($url->getSource(), $toFlush)) {
                    $this->em->persist($url);
                    $toFlush[] = $url->getSource();
                }
            }
            if ($nb % self::BATCH_SIZE == 0) {
                $this->em->flush();
                $this->em->clear();
                $toFlush = array();
            }
            $nb++;
        }
        $this->em->flush();

        return $importError;
    }

}
