<?php
namespace AppBundle\Service;

use AppBundle\Entity\TExhibitors;
use AppBundle\Entity\TActivityArea;
use Doctrine\Common\Collections\ArrayCollection;

class MapDataService
{

    private $doctrine;

    private $dataFlux = array();

    private $exhibitorsList = array();
    private $catParentList = array();

    public function __construct($doctrine, $dataFlux)
    {
        $this->doctrine = $doctrine;
        $this->dataFlux = $dataFlux;
    }

    public function updateData()
    {
        $this->parseData();
        
        $this->updateDbData();
    }

    public function getExhibitors()
    {
        return $this->dataFlux["exhibitors"]["exhibitor"];
    }

    public function getCountries()
    {
        return $this->dataFlux['countries']['country'];
    }

    public function getExhibitorCategories()
    {
        return $this->dataFlux["exhibitor_categories"]["exhibitor_category"];
    }

    public function getCountryById($id)
    {
        return array_filter($this->getCountries(), function ($v, $k) use ($id) {
            return $v['id'] == $id;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getExhibitorCategoriesById($id)
    {
        return array_filter($this->getExhibitorCategories(), function ($v, $k) use ($id) {
            return $v['id'] == $id;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getCatOfExhibitor($cats)
    {
        $categories = array();
        foreach ($cats as $Cat) {
            if (isset($Cat["identifiant"]))
                $categories = array_merge($categories, $this->getExhibitorCategoriesById($Cat["identifiant"]));
        }
        return $categories;
    }

    public function parseData()
    {
        foreach ($this->getExhibitors() as $exhibitor) {
            
            if (isset($exhibitor['categories']))
                $catList = $this->getCatOfExhibitor($exhibitor['categories']['categorie']);
            if (isset($exhibitor['country']))
                $contry = $this->getCountryById($exhibitor['country']);
            
            $exhibitor['categories'] = $catList;
            $exhibitor['country'] = $contry;
            $this->exhibitorsList[] = $exhibitor;
        }
        
        foreach($this->getExhibitorCategories() as $Cat){
            if (isset($Cat["parent_id"]) && $Cat["parent_id"]=='0')
                $this->catParentList[] = $Cat;
        }
    }

    public function updateDbData()
    {
        $entityManager = $this->doctrine->getManager();
        $exhibitorRepo = $this->doctrine->getRepository('AppBundle\Entity\TExhibitors');
        $ActivityRepo = $this->doctrine->getRepository('AppBundle\Entity\TActivityArea');
        
        foreach($this->catParentList as $catParent){
            $catEntity = $ActivityRepo->findOneBy(array(
                'vchCode' => $this->getDataFromArray($catParent,"id" )
            ));
            if(!$catEntity){
                $catEntity = new TActivityArea();
                $catEntity->setVchCode($this->getDataFromArray($catParent,"id" ));
            }
            $catEntity->setVchName($this->getDataFromArray($catParent,"title_fr" ));
            $catEntity->setVchNameEn($this->getDataFromArray($catParent,"title_en" ));
            $catEntity->setVchParentCode('0');
            $entityManager->persist($catEntity);
            $entityManager->flush();
        }
        echo count($this->exhibitorsList);
        foreach ($this->exhibitorsList as $exhibitor) {
            
           
            $exhibitorEntity = $exhibitorRepo->findOneBy(array(
                'vchCode' => $exhibitor['numeroCEN']
            ));
            if (! $exhibitorEntity) {
                $exhibitorEntity = new TExhibitors();
                $exhibitorEntity->setVchCode($this->getDataFromArray($exhibitor, 'numeroCEN'));
                $exhibitorEntity->setDtStart(new \DateTime('2018-10-23 00:00:00'));
                $exhibitorEntity->setDtEnd(new \DateTime('2018-10-27 00:00:00'));
                $exhibitorEntity->setBActive(true);
            }
            
            $exhibitorEntity->setVchName($this->getDataFromArray($exhibitor, "title_fr"));
            $exhibitorEntity->setVchAdresse($this->getDataFromArray($exhibitor, "address_1"));
            $exhibitorEntity->setVchAdresse2($this->getDataFromArray($exhibitor, "address_2"));
            $exhibitorEntity->setVchCp($this->getDataFromArray($exhibitor, "postcode"));
            $exhibitorEntity->setVchVille($this->getDataFromArray($exhibitor, "city"));
            $exhibitorEntity->setVchTel($this->getDataFromArray($exhibitor, "phone"));
            $exhibitorEntity->setVchEmail($this->getDataFromArray($exhibitor, "email"));
            $exhibitorEntity->setVchTwitter($this->getDataFromArray($exhibitor, "twitter"));
            $exhibitorEntity->setVchFacebook($this->getDataFromArray($exhibitor, "facebook"));
            $exhibitorEntity->setVchLinkedin($this->getDataFromArray($exhibitor, "linkedin"));
            
            $exhibitorEntity->setVchWeb($this->getDataFromArray($exhibitor, "website"));
            
            if ($countries = $this->getDataFromArray($exhibitor, "country")) {
                foreach($countries as $country)
                    $exhibitorEntity->setVchCountryname($this->getDataFromArray($country, "title_fr"));
            }
            if ($contacts = $this->getDataFromArray($exhibitor,"contacts")){
                $contact = $this->getDataFromArray($contacts,"contact");
                $exhibitorEntity->setVchNomcontact($this->getDataFromArray($contact,"salutation_fr")." ".$this->getDataFromArray($contact,"last_name")." ".$this->getDataFromArray($contact,"last_name"));
                $exhibitorEntity->setVchTelcontact($this->getDataFromArray($contact,"phone"));
                $exhibitorEntity->setVchFunctioncontact($this->getDataFromArray($contact,"function"));
                $exhibitorEntity->setVchEmailcontact($this->getDataFromArray($contact,"e_mail"));
            }
            
            if($places = $this->getDataFromArray($exhibitor,"places")){
                $place = $this->getDataFromArray($places,"place");
                $exhibitorEntity->setVchStand($place);
                //echo $place."<br/>";
                
            }
            $arrayCollection = new ArrayCollection();
            if ($categories  = $this->getDataFromArray($exhibitor,"categories" )){
                
                foreach($categories as $cat){
                    $catEntity = $ActivityRepo->findOneBy(array(
                        'vchCode' => $this->getDataFromArray($cat,"id" )
                    ));
                    if(!$catEntity){
                    $catEntity = new TActivityArea();
                    $catEntity->setVchCode($this->getDataFromArray($cat,"id" ));
                    }
                    $catEntity->setVchName($this->getDataFromArray($cat,"title_fr" ));
                    $catEntity->setVchNameEn($this->getDataFromArray($cat,"title_en" ));
                    $catEntity->setVchParentCode($this->getDataFromArray($cat,"parent_id" ));
                    if (false === $arrayCollection->contains($catEntity)) {
                        $arrayCollection->add($catEntity);
                    }
                    //$exhibitorEntity->setTExhibitionActivityI($catEntity);
                }
                
            }
            $exhibitorEntity->setTExhibitionActivityI($arrayCollection);
                //$contact = $this->getDataFromArray($contacts,"contact");
                //$exhibitorEntity->setVchNomcontact($this->getDataFromArray($contact,"salutation_fr")." ".$this->getDataFromArray($contact,"last_name")." ".$this->getDataFromArray($contact,"last_name"));
           
            $entityManager->persist($exhibitorEntity);
            $entityManager->flush();
        }
    }

    public function getDataFromArray($exhibitor, $code, $default = "")
    {
        if (isset($exhibitor[$code]))
            return $exhibitor[$code];
        return $default;
    }
}

