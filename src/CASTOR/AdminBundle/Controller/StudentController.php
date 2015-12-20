<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/12/15
 * Time: 3:12 AM
 */

namespace CASTOR\AdminBundle\Controller;


use CASTOR\AdminBundle\Entity\Eleves;
use CASTOR\AdminBundle\Form\ElevesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller {

    public function registerAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $eleve = new Eleves();
        $form = $this->get('form.factory')->create(new ElevesType(), $eleve);

        if ($form->handleRequest($request)->isValid()) {
            $eleve->setCode(rand(0, 9)."8A".rand(0, 9).rand(0, 9).date('m').date('s'));
            $eleve->setDateAdd(new \datetime);
            $eleve->setDateUpd(new \datetime);
            $em->persist($eleve);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La classe a  bien été enregistrée.');

            return $this->redirect($this->generateUrl('castor_admin_classes'));


        }

        return $this->render('CASTORAdminBundle:Eleves:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}