<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Societe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Societe controller.
 *
 * @Route("societe")
 */
class SocieteController extends Controller
{
    /**
     * Lists all societe entities.
     *
     * @Route("/societe_list", name="societe_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $em = $this->getDoctrine()->getManager();

        $societes = $em->getRepository('AppBundle:Societe')->findAll();

        return $this->render('societe/index.html.twig', array(
            'societes' => $societes,
        ));
    }

    /**
     * Creates a new societe entity.
     *
     * @Route("/new", name="societe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $societe = new Societe();
        $form = $this->createForm('AppBundle\Form\SocieteType', $societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($societe);
            $em->flush();

            return $this->redirectToRoute('societe_show', array('id' => $societe->getId()));
        }

        return $this->render('societe/new.html.twig', array(
            'societe' => $societe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a societe entity.
     *
     * @Route("/{id}", name="societe_show")
     * @Method("GET")
     */
    public function showAction(Societe $societe, Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $deleteForm = $this->createDeleteForm($societe);

        return $this->render('societe/show.html.twig', array(
            'societe' => $societe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing societe entity.
     *
     * @Route("/{id}/edit", name="societe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Societe $societe)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $deleteForm = $this->createDeleteForm($societe);
        $editForm = $this->createForm('AppBundle\Form\SocieteType', $societe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('societe_edit', array('id' => $societe->getId()));
        }

        return $this->render('societe/edit.html.twig', array(
            'societe' => $societe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a societe entity.
     *
     * @Route("/{id}", name="societe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Societe $societe)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $form = $this->createDeleteForm($societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($societe);
            $em->flush();
        }

        return $this->redirectToRoute('societe_index');
    }

    /**
     * Creates a form to delete a societe entity.
     *
     * @param Societe $societe The societe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Societe $societe)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('societe_delete', array('id' => $societe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
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
