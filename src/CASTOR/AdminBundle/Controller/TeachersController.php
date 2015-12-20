<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/12/15
 * Time: 7:25 PM
 */

namespace CASTOR\AdminBundle\Controller;


use CASTOR\AdminBundle\Entity\Teachers;
use CASTOR\AdminBundle\Form\TeachersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeachersController extends Controller {

    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('CASTORAdminBundle:Teachers')->findAll();

        return $this->render('CASTORAdminBundle:Teachers:list.html.twig', array(
            'list' => $list
        ));

    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $teachers = new Teachers();
        $form = $this->get('form.factory')->create(new TeachersType(), $teachers);

        if ($form->handleRequest($request)->isValid()) {



            $em->persist($teachers);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le prof a  bien été enregistrée.');

            return $this->redirect($this->generateUrl('castor_admin_list_teachers'));


        }
        return $this->render('CASTORAdminBundle:Teachers:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

}