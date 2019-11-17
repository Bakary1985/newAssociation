<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nomenclature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Nomenclature controller.
 *
 * @Route("nomenclature")
 */
class NomenclatureController extends Controller
{
    /**
     * Lists all nomenclature entities.
     *
     * @Route("/nomenclature_list", name="nomenclature_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $em = $this->getDoctrine()->getManager();

        $nomenclatures = $em->getRepository('AppBundle:Nomenclature')->findAll();

        return $this->render('nomenclature/index.html.twig', array(
            'nomenclatures' => $nomenclatures,
        ));
    }

    /**
     * Creates a new nomenclature entity.
     *
     * @Route("/new", name="nomenclature_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $nomenclature = new Nomenclature();
        $form = $this->createForm('AppBundle\Form\NomenclatureType', $nomenclature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nomenclature);
            $em->flush();

            return $this->redirectToRoute('nomenclature_show', array('id' => $nomenclature->getId()));
        }

        return $this->render('nomenclature/new.html.twig', array(
            'nomenclature' => $nomenclature,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nomenclature entity.
     *
     * @Route("/{id}", name="nomenclature_show")
     * @Method("GET")
     */
    public function showAction(Nomenclature $nomenclature, Request $request)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $deleteForm = $this->createDeleteForm($nomenclature);

        return $this->render('nomenclature/show.html.twig', array(
            'nomenclature' => $nomenclature,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nomenclature entity.
     *
     * @Route("/{id}/edit", name="nomenclature_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Nomenclature $nomenclature)
    {

        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $deleteForm = $this->createDeleteForm($nomenclature);
        $editForm = $this->createForm('AppBundle\Form\NomenclatureType', $nomenclature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nomenclature_index');
        }

        return $this->render('nomenclature/edit.html.twig', array(
            'nomenclature' => $nomenclature,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nomenclature entity.
     *
     * @Route("/{id}", name="nomenclature_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Nomenclature $nomenclature)
    {
        if($this->Check($request)==false){
            return $this->redirectToRoute('security');
        }
        $form = $this->createDeleteForm($nomenclature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nomenclature);
            $em->flush();
        }

        return $this->redirectToRoute('nomenclature_index');
    }

    /**
     * Creates a form to delete a nomenclature entity.
     *
     * @param Nomenclature $nomenclature The nomenclature entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nomenclature $nomenclature)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nomenclature_delete', array('id' => $nomenclature->getId())))
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
