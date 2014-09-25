<?php

namespace WBB\BarBundle\Importer;

use Ddeboer\DataImport\Reader\CsvReader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator;
use WBB\BarBundle\Logger\LegalAgeLogger;

class LegalAgeImporter
{

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var LegalAgeLogger
     */
    private $logger;

    public function __construct(ObjectManager $em, Validator $validator, LegalAgeLogger $logger)
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

        $reader->setHeaderRowNumber(0);
        foreach ($reader as $data) {
            $country = $this->em->getRepository('WBBCoreBundle:Country')->findOneBy(array(
                'acronym' => $data['ShortISO']
            ));

            if ($country) {
                $country->setDrinkingAge($data['MinAge']);
            } else {
                $importError = true;
                $this->logger->info('The country with ShortISO : "' . $data['ShortISO'] . '" does not exist in the database');
            }
        }
        $this->em->flush($country);

        return $importError;
    }

}
