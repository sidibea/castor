<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/11/15
 * Time: 3:09 PM
 */

namespace CASTOR\FrontBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller {

    public function indexAction(){

        return $this->render('CASTORFrontBundle:Pages:index.html.twig');
    }
    public function presentationAction(){

        return $this->render('CASTORFrontBundle:Pages:presentation.html.twig');
    }

    public function galleryAction(){

        return $this->render('CASTORFrontBundle:Pages:gallery.html.twig');
    }
    public function contactAction(){

        return $this->render('CASTORFrontBundle:Pages:contact.html.twig');
    }

}