<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nomenclature;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Statistique;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StatistiqueController extends Controller
{
    /**
     *
     * @Route("/states",name="states")
     * @param Request $request
     * @return JsonResponse
     */
    public function stateAction(Request $request, ObjectManager $manager)
    {
      $id_nomenclature = $request->request->get('theme');
       $id_produit = $request->request->get('produit');
       $map = $request->request->get('map');
       $calendrier = $request->request->get('calendrier');




        if ($id_nomenclature !==null){
            $data = $manager->getRepository(Nomenclature::class)->findOneBy(array('id'=>$id_nomenclature));
            $states= new Statistique();
            $states->setIdnomenclature($data->getId());
            $states->setZone($data->getNom());
            $states->setDateclick(new \DateTime());
            $manager->persist($states);
            $manager->flush();
        }
        if ($id_produit!==null){
            $data = $manager->getRepository(Produit::class)->findOneBy(array('id'=>$id_produit));
            $states= new Statistique();
            $states->setIdproduit($data->getId());
            $states->setZone($data->getNomFr());
            $states->setDateclick(new \DateTime());
            $manager->persist($states);
            $manager->flush();
        }
        if ($map!==null){
            $states= new Statistique();
            $states->setZone($map);
            $states->setDateclick(new \DateTime());
            $manager->persist($states);
            $manager->flush();
        }
        if ($calendrier!==null){

            $states= new Statistique();
            $states->setZone($calendrier);
            $states->setDateclick(new \DateTime());
            $manager->persist($states);
            $manager->flush();
        }

        return new JsonResponse(array(
            'theme'=>$id_nomenclature,
            'produit'=>$id_produit,
            'map'=>$map,
            'calendrier'=>$calendrier,
        ));
        die;
    }


}
