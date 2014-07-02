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

class SemsoftController extends Controller
{
    public function importAction(Request $request) {

        // Get FileId to "import"
        $param = $request->request;
        $fileId = (int)trim($param->get("fileId"));

        $curType = trim($param->get("fileType"));
        $uploadedFile = $request->files->get("csvFile");

        var_dump($param);die;

        // if upload was not ok, just redirect to "shortyStatWrongPArameters"
        if (!CSVTypes::existsType($curType) || $uploadedFile == null) return $this->redirect($this->generateUrl('shortyStatWrongParameters'));

        // generate dummy dir
        $dummyImport=getcwd()."/dummyImport";
        $fname="directly.csv";
        $filename=$dummyImport."/".$fname;
        @mkdir($dummyImport);
        @unlink($filename);

        // move file to dummy filename
        $uploadedFile->move($dummyImport,$fname);

        echo "Starting to Import ".$filename.", Type: ".CSVTypes::getNameOfType($curType)."<br />n";

        // open file
        $source = new StreamSource($filename);
        if ($source===false) die("Can't open filestream $filename");
        $file = $source->getFile();
        if ($file===false)   die("Can't open file $filename");

        // Create and configure the reader
        $csvReader = new CsvReader($file,",");
        if ($csvReader===false) die("Can't create csvReader $filename");
        $csvReader->setHeaderRowNumber(0);

        // this must be done to import CSVs where one of the data-field has CRs within!
        $file->setFlags(SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::READ_AHEAD);

        // Set Database into "nonchecking Foreign Keys"
        $em=$this->getDoctrine()->getManager();
        $em->getConnection()->exec("SET FOREIGN_KEY_CHECKS=0;");

        // Create the workflow
        $workflow = new Workflow($csvReader);
        if ($workflow===false) die("Can't create workflow $filename");
        $curEntityClass=CSVTypes::getEntityClass($curType);
        $writer = new DoctrineWriter($em, $curEntityClass);
        $writer->setTruncate(false);

        $entityMetadata=$em->getClassMetadata($curEntityClass);
        $entityMetadata->setIdGeneratorType(DoctrineORMMappingClassMetadata::GENERATOR_TYPE_NONE);

        $workflow->addWriter($writer);

        $workflow->process();

        // RESetting Database Check Status
        $em->getConnection()->exec("SET FOREIGN_KEY_CHECKS=1;");

        // After successfully import, some files need special treatment --> Reset some DB fields
        if ($curType==CSVTypes::SPRUECHE) {
            $q=$em->createQuery("UPDATE FungusShortyBundle:Spruch s
                            SET s.dupeChecked = false");
            $q->execute();
        }

        return $this->render('FungusShortyBundle:CSV:csv_import.html.twig');
    }
}