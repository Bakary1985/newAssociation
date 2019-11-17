<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Excel;
use AppBundle\Entity\ExcelData;
use AppBundle\Entity\Nomenclature;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Salon;
use AppBundle\Entity\Societe;
use AppBundle\Form\ExcelType;
use AppBundle\Service\Auth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ExcelController extends Controller
{
    /**
     * @Route("/excel_societe", name="excel_societe")
     * @param Request $request
     * @return Response
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
            require_once '../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }

        $excel = new Excel();
        $form = $this->createForm(ExcelType::class, $excel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $excel->getFichier();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('excel_directory'),
                    $fileName
                );
            } catch (FileException $e) {
            }
            /*
             * hydrater l'entite avec le nom du fichier
             */
            $excel->setFichier($fileName);
            /**
             * Lecture du fichier Excel
             */
            $reader = \PHPExcel_IOFactory::createReaderForFile($this->getParameter('excel_directory') . '/' . $fileName);
            $excelObj = $reader->load($this->getParameter('excel_directory') . '/' . $fileName);
            $worksheet = $excelObj->getSheet(0);
            $lastRow = $worksheet->getHighestRow();
            $data = array();
            for ($row = 2; $row <= $lastRow; $row++) {
                // var_dump($worksheet->getCell('D' . $row)->getValue());
                //echo '<pre>';print_r($worksheet->getCell('A' . $row)->getValue());echo '</pre>';
                $data [] = array(

                    'noms' => $worksheet->getCell('A' . $row)->getValue(),
                    'stand' => $worksheet->getCell('B' . $row)->getValue(),
                    'adresse' => $worksheet->getCell('C' . $row)->getValue(),
                    'rue' => $worksheet->getCell('D' . $row)->getValue(),
                    'code_postal' => $worksheet->getCell('E' . $row)->getValue(),
                    'ville' => $worksheet->getCell('F' . $row)->getValue(),
                    'pays' => $worksheet->getCell('G' . $row)->getValue(),
                    'tel' => $worksheet->getCell('H' . $row)->getValue(),
                    'personne_contact' => $worksheet->getCell('I' . $row)->getValue(),
                    'contact_email' => $worksheet->getCell('J' . $row)->getValue(),
                    'site' => $worksheet->getCell('K' . $row)->getValue(),
                    'description' => $worksheet->getCell('L' . $row)->getValue()
                );
            }

            foreach ($data as $datum){
                $societe = new Societe();
                $societe->setNom($datum['noms']);
                $societe->setStand($datum['stand']);
                $societe->setAdresse($datum['adresse']);
                $societe->setRue($datum['rue']);
                $societe->setCodePostal($datum['code_postal']);
                $societe->setVille($datum['ville']);
                $societe->setPays($datum['pays']);
                $societe->setTel($datum['tel']);
                $societe->setPersonneContact($datum['personne_contact']);
                $societe->setContactEmail($datum['contact_email']);
                $societe->setSite($datum['site']);
                $societe->setDescription($datum['description']);

                echo '<pre>';print_r($societe);echo '</pre>';
                $manager->persist($societe);
                //$manager->flush();
            }
            $manager->flush();
            die;

            /**
             * enregistrement dans la base de données
             */
            //$saveDatas = $this->saveData($data);
            //return $this->render('excel/confirmation.html.twig',['nombre'=>count($saveDatas)]);
        }

        return $this->render('excel/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/excel_salon", name="excel_salon")
     * @param Request $request
     * @return Response
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function salonAction(Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $manager = $this->getDoctrine()->getManager();
        $datas = $manager->getRepository(Societe::class)->findAll();
        $envoie = array();
        $result = "";
        foreach ($datas as $data) {
            $envoie[]=$data->getId();
        }

        $excel = new Excel();
        $form = $this->createForm(ExcelType::class, $excel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $excel->getFichier();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('excel_directory'),
                    $fileName
                );
            } catch (FileException $e) {
            }
            /*
             * hydrater l'entite avec le nom du fichier
             */
            $excel->setFichier($fileName);
            /**
             * Lecture du fichier Excel
             */
            $reader = \PHPExcel_IOFactory::createReaderForFile($this->getParameter('excel_directory') . '/' . $fileName);
            $excelObj = $reader->load($this->getParameter('excel_directory') . '/' . $fileName);
            $worksheet = $excelObj->getSheet(0);
            $lastRow = $worksheet->getHighestRow();
            $data = array();

            for ($row = 2; $row <= $lastRow; $row++) {
                // var_dump($worksheet->getCell('D' . $row)->getValue());
                $data [] = array(
                    'nom' => $worksheet->getCell('B' . $row)->getValue(),

                );
            }
            $index= 0;
            foreach ($data as $datum){
                $salon = new Salon();
                $salon->setName($datum['nom']);
                $salon->setSociete($datas[$index]);

                $index++;

                echo '<pre>';print_r($salon);echo '</pre>';
                $manager->persist($salon);

            }

            $manager->flush();
            /**
             * enregistrement dans la base de données
             */
            //$saveDatas = $this->saveData($data);
            //return $this->render('excel/confirmation.html.twig',['nombre'=>count($saveDatas)]);
        }

        return $this->render('excel/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/excel_nomenclatures", name="excel_nomenclature")
     * @param Request $request
     * @return Response
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function nomenclatureAction(Request $request)
    {
        require_once '../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

        $manager = $this->getDoctrine()->getManager();

        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }

        $excel = new Excel();
        $form = $this->createForm(ExcelType::class, $excel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $excel->getFichier();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('excel_directory'),
                    $fileName
                );
            } catch (FileException $e) {
            }
            /*
             * hydrater l'entite avec le nom du fichier
             */
            $excel->setFichier($fileName);
            /**
             * Lecture du fichier Excel
             */
            $reader = \PHPExcel_IOFactory::createReaderForFile($this->getParameter('excel_directory') . '/' . $fileName);
            $excelObj = $reader->load($this->getParameter('excel_directory') . '/' . $fileName);
            $worksheet = $excelObj->getSheet(0);
            $lastRow = $worksheet->getHighestRow();
            $data = array();

            for ($row = 2; $row <= $lastRow; $row++) {
                $data [] = array(

                    'nom' => $worksheet->getCell('A' . $row)->getValue(),
                    'stand' => $worksheet->getCell('B' . $row)->getValue(),
                    'adresse' => $worksheet->getCell('C' . $row)->getValue(),
                    'rue' => $worksheet->getCell('D' . $row)->getValue(),
                    'code_postal' => $worksheet->getCell('E' . $row)->getValue(),
                    'ville' => $worksheet->getCell('F' . $row)->getValue(),
                    'pays' => $worksheet->getCell('G' . $row)->getValue(),
                );
            }

            foreach ($data as $datum){
                $nomenclatureDb =  $manager->getRepository(Nomenclature::class)->findOneByNom($datum['stand']);
                if(!$nomenclatureDb instanceof Nomenclature){
                    $societe = new Nomenclature();
                    $societe->setNom($datum['stand']);
                    $societe->setNomFr($datum['stand']);
                    $societe->setNomEn($datum['adresse']);
                    $societe->setLienParcours($datum['rue']);
                    $societe->setCouleur($datum['code_postal']);
                    $societe->setDateModif($datum['ville']);
                    echo '<pre>';print_r($datum['stand']);echo '</pre>';
                    $manager->persist($societe);
                    $manager->flush();
                }

            }

           $manager->flush();
            /**
             * enregistrement dans la base de données
             */
            //$saveDatas = $this->saveData($data);
            //return $this->render('excel/confirmation.html.twig',['nombre'=>count($saveDatas)]);
        }

        return $this->render('excel/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/excel_produit", name="excel_produit")
     * @param Request $request
     * @return Response
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function produitAction(Request $request)
    {
        require_once '../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $manager = $this->getDoctrine()->getManager();
        $datasociete = $manager->getRepository(Societe::class)->findAll();
        $datanomen = $manager->getRepository(Nomenclature::class)->findAll();
        $datasalon = $manager->getRepository(Salon::class)->findAll();

        $excel = new Excel();
        $form = $this->createForm(ExcelType::class, $excel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $excel->getFichier();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('excel_directory'),
                    $fileName
                );
            } catch (FileException $e) {
            }
            /*
             * hydrater l'entite avec le nom du fichier
             */
            $excel->setFichier($fileName);
            /**
             * Lecture du fichier Excel
             */
            $reader = \PHPExcel_IOFactory::createReaderForFile($this->getParameter('excel_directory') . '/' . $fileName);
            $excelObj = $reader->load($this->getParameter('excel_directory') . '/' . $fileName);
            $worksheet = $excelObj->getSheet(0);
            $lastRow = $worksheet->getHighestRow();
            $data = array();

            for ($row = 2; $row <= $lastRow; $row++) {

               // var_dump($worksheet->getCell('D' . $row)->getValue());
                $data [] = array(
                    'nom_fr' => $worksheet->getCell('D' . $row)->getValue(),
                    'nom_en' => $worksheet->getCell('E' . $row)->getValue(),
                    'univers_technologique' => $worksheet->getCell('F' . $row)->getValue(),
                    'marche' => $worksheet->getCell('G' . $row)->getValue(),
                    'prix' => $worksheet->getCell('H' . $row)->getValue(),
                    'description_fr' => $worksheet->getCell('I' . $row)->getValue(),
                    'description_en' => $worksheet->getCell('J' . $row)->getValue(),
                    'service_rendu_fr' => $worksheet->getCell('K' . $row)->getValue(),
                    'service_rendu_en' => $worksheet->getCell('L' . $row)->getValue(),

                    'img' => $worksheet->getCell('M' . $row)->getValue(),
                    'qcode' => $worksheet->getCell('N' . $row)->getValue(),
                    'pdf' => $worksheet->getCell('O' . $row)->getValue(),
                    'avant' => $worksheet->getCell('P' . $row)->getValue(),
                    'theme' => $worksheet->getCell('Q' . $row)->getValue(),
                    'nominer' => $worksheet->getCell('R' . $row)->getValue(),
                    'lien_produit_fr' => $worksheet->getCell('S' . $row)->getValue(),
                    'lien_produit_en' => $worksheet->getCell('T' . $row)->getValue(),

                );
               // var_dump($worksheet->getCell('D' . $row)->getValue());
            }
            $index= 0;
            foreach ($data as $datum){

                $nomenclature = $manager->getRepository(Nomenclature::class)->findOneByNom($datum['theme']);
                $societes = $manager->getRepository(Societe::class)->findOneByNom($datum['pdf']);
                $salons = $manager->getRepository(Salon::class)->findOneByName($datum['avant']);
                $salon = new Produit();
                $salon->setIdSociete($societes);
                $salon->setSalon($salons);
                //$salon->setNomenclature($datanomen[$index]);
                $salon->setNomenclature($nomenclature);
                $salon->setNomFr($datum['nom_fr']);
                $salon->setNomEn($datum['nom_en']);
                $salon->setUniversTechnologique($datum['univers_technologique']);
                $salon->setMarche($datum['marche']);
                $salon->setMarche($datum['prix']);
                $salon->setDescriptionFr($datum['description_fr']);
                $salon->setDescriptionEn($datum['description_en']);
                $salon->setServiceRenduEn($datum['service_rendu_en']);
                $salon->setServiceRenduFr($datum['service_rendu_fr']);
                $salon->setImg($datum['img']);

                $salon->setQcode($datum['img']);
                $salon->setPdf($datum['qcode']);
                $salon->setAvant($datum['pdf']);
                $salon->setTheme($datum['theme']);
                $salon->setNominer($datum['nominer']);
                $salon->setLienProduitFr($datum['lien_produit_fr']);
                $salon->setLienProduitEn($datum['lien_produit_en']);
                $index++;

                echo '<pre>';print_r($datum['service_rendu_en']);echo '</pre>';
                $manager->persist($salon);

            }

           $manager->flush();
            /**
             * enregistrement dans la base de données
             */
            //$saveDatas = $this->saveData($data);
            //return $this->render('excel/confirmation.html.twig',['nombre'=>count($saveDatas)]);
        }

        return $this->render('excel/index.html.twig', [
            'form' => $form->createView()
        ]);
    }





    /**
     * @Route("/excel/liste", name="excel_liste")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function liste(Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $manager = $this->getDoctrine()->getManager();
        $data = $manager->getRepository(ExcelData::class)->findAll();
        return $this->render('Excel/liste.html.twig', [
            'datas' => $data
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @param $sheetData
     * @return array
     */
    private function saveData($sheetData)
    {
        $manager = $this->getDoctrine()->getManager();
        $donnee = array();
        foreach ($sheetData as $ligne) {
            $excelData = $manager->getRepository(ExcelData::class)->findOneByEmail($ligne['email']);
            if (!$excelData instanceof ExcelData) {
                $data = new ExcelData();
                $data->setPrenom($ligne['prenom']);
                $data->setNom($ligne['nom']);
                $data->setSociete($ligne['societe']);
                $data->setSoiree($ligne['soiree']);
                $data->setEtat($ligne['etat']);
                $data->setEmail($ligne['email']);
                $data->setEnvoie(0);
                $donnee[] = $data;
                $manager->persist($data);
            }
        }
        $manager->flush();
        return $donnee;
    }
    public function Check(Request $request){
        $status = false;
        $session = $request->getSession();
        if ($session->get('authentification')=='OK'){
            $status =  true;
        }else{
            $status =  false;
        }
        return $status;
    }

}
