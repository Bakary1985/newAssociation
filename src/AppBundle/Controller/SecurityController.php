<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{

    /**
     * @Route("/security/authentification", name="security")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $identifiant = $request->request->get('identifiant');
        $password = $request->request->get('password');
        if($identifiant=='batimat2019' && $password=='batimat2019'){
            $session->set('authentification','OK');
            return $this->redirectToRoute('produit_index');
        }
        return $this->render('Security/index.html.twig', [
        ]);
    }

    /**
     * @Route("/remove/authentification", name="remove")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeAction(Request $request)
    {
        $session = $request->getSession();
        $session->set('authentification','');
        return $this->redirectToRoute("security");
    }

    /**
     * @Route("/batimat/admin", name="batimat_admin")
     */
    public function administrationAction(){
        return $this->render('Security/admin.html.twig', []);
    }
}


