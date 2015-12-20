<?php

namespace CASTOR\AdminBundle\Controller;

use CASTOR\AdminBundle\Entity\classes;
use CASTOR\AdminBundle\Entity\date_trimestriel;
use CASTOR\AdminBundle\Entity\Param;
use CASTOR\AdminBundle\Form\classesEditType;
use CASTOR\AdminBundle\Form\classesType;
use CASTOR\AdminBundle\Form\date_trimestrielType;
use CASTOR\AdminBundle\Form\ParamType;
use CASTOR\AdminBundle\Form\trimestre2Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('CASTORAdminBundle:Pages:index.html.twig');
    }

    public function paramAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $param = $em->getRepository('CASTORAdminBundle:Param')->find(1);

        $form = $this->get('form.factory')->create(new ParamType(), $param);

        if ($form->handleRequest($request)->isValid()) {
            $logo_file = $form->get('logo')->getData();
            $signature_file = $form->get('signatureDirecteur')->getData();


            if(null === $logo_file){
                $param->setLogo($param->getLogo());
            }else{
                $extension = $logo_file->guessClientExtension();
                $logo =  md5(uniqid()).".".$extension;
                $UploadDir = __DIR__.'/../../../../web/admin/uploads/img/';
                if(file_exists($UploadDir.$param->getLogo())){
                    unlink($UploadDir.$param->getLogo());
                }
                $logo_file->move($UploadDir, $logo);
                $param->setLogo($logo);

            }

            if(null === $signature_file){
                $param->setSignatureDirecteur($param->getSignatureDirecteur());
            }else{
                $extension = $signature_file->guessClientExtension();
                $signature = md5(uniqid()) . "." . $extension;
                $UploadDir = __DIR__ . '/../../../../web/admin/uploads/img/';
                if(file_exists($UploadDir.$param->getSignatureDirecteur())){
                    unlink(($UploadDir.$param->getSignatureDirecteur()));
                }
                $signature_file->move($UploadDir, $signature);

                $param->setSignatureDirecteur($signature);
            }


            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Les parametres ont  bien ete enregistrées.');

            return $this->redirect($this->generateUrl('castor_admin_parametrage'));
        }

        return $this->render('CASTORAdminBundle::param.html.twig', array(
            'form' => $form->createView(),
            'param' => $param

        ));

    }














































    public function classesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('CASTORAdminBundle:classes')->findAll();

        return $this->render('CASTORAdminBundle:Classes:classes.html.twig', array(
            'list' => $list
        ));
    }
    public function addClassesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $classe = new classes();
        $form = $this->get('form.factory')->create(new classesType(), $classe);

        if ($form->handleRequest($request)->isValid()) {



            $em->persist($classe);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La classe a  bien été enregistrée.');

            return $this->redirect($this->generateUrl('castor_admin_classes'));


        }
        return $this->render('CASTORAdminBundle:Classes:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editClassesAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $classe = $em->getRepository('CASTORAdminBundle:classes')->find($id);

        $form = $this->get('form.factory')->create(new classesEditType(), $classe);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus a  bien ete enregistrée.');

            return $this->redirect($this->generateUrl('castor_admin_classes'));


        }

        return $this->render('CASTORAdminBundle:Classes:edit.html.twig', array(
            'form' => $form->createView(),
            'classe' => $classe
        ));



    }
}

