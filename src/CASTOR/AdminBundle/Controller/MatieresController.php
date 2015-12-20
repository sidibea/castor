<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/12/15
 * Time: 7:26 PM
 */

namespace CASTOR\AdminBundle\Controller;



use CASTOR\AdminBundle\Entity\Matieres;
use CASTOR\AdminBundle\Form\MatieresEditType;
use CASTOR\AdminBundle\Form\MatieresType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MatieresController extends Controller {

    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('CASTORAdminBundle:Matieres')->findAll();

        return $this->render('CASTORAdminBundle:Matieres:list.html.twig', array(
            'list' => $list
        ));
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $matieres = new Matieres();
        $form = $this->get('form.factory')->create(new MatieresType(), $matieres);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($matieres);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La matiere a  bien été enregistrée.');

            return $this->redirect($this->generateUrl('castor_admin_list_matieres'));


        }
        return $this->render('CASTORAdminBundle:Matieres:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $matieres = $em->getRepository('CASTORAdminBundle:Matieres')->find($id);

        $form = $this->get('form.factory')->create(new MatieresEditType(), $matieres);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus a  bien ete enregistrée.');

            return $this->redirect($this->generateUrl('castor_admin_list_matieres'));
        }

        return $this->render('CASTORAdminBundle:Matieres:edit.html.twig', array(
            'form' => $form->createView(),
            'matieres' => $matieres
        ));
    }
}