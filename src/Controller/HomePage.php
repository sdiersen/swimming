<?php
/**
 * Created by PhpStorm.
 * User: cippio
 * Date: 9/14/18
 * Time: 1:31 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePage extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="swimming_lesson_homepage")
     */

    public function homepage() {
        return $this->render('home/homepage.html.twig', [

        ]);
    }
}