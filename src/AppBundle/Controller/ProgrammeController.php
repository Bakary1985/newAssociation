<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Nomenclature;
use AppBundle\Entity\Produit;
use AppBundle\Entity\TAtelier;
use AppBundle\Entity\TConferencetype;
use AppBundle\Entity\TSalle;
use AppBundle\Entity\TPays;
use AppBundle\Entity\TThematique;
use AppBundle\Entity\Vote;
use Doctrine\Common\Persistence\ObjectManager;
use Slot\MandrillBundle\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TExhibitionStand;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\TExhibitors;
use AppBundle\Service\MapDataService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\TConferencetypeT;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class ProgrammeController extends Controller
{

    /**
     *
     * @Route("/",name="accueil")
     */
    public function showrrrrAction(Request $request, ObjectManager $manager)
    {
 
        return $this->render('AppBundle:index:index.html.twig', array());
    }

    
}
