<?php

namespace App\Controller;

use App\Entity\SwimLevels;
use App\Form\SwimLevelsType;
use App\Repository\SwimLevelsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/swim/levels")
 */
class SwimLevelsController extends AbstractController
{
    /**
     * @Route("/", name="swim_levels_index", methods="GET")
     */
    public function index(SwimLevelsRepository $swimLevelsRepository): Response
    {
        //return $this->render('swim_levels/index.html.twig', ['swim_levels' => $swimLevelsRepository->findAll()]);
        return $this->render('swim_levels/index.html.twig', ['swim_levels' => $swimLevelsRepository->findAllOrderByProgression()]);
    }

    /**
     * @Route("/new", name="swim_levels_new", methods="GET|POST")
     */
    public function new(SwimLevelsRepository $swimLevelsRepository): Response
    {
        $swimLevel = new SwimLevels();
        $errors = [];
        !empty($_POST["title"]) ? $swimLevel->setTitle($_POST["title"]) : $errors["title"] = "Title was empty";
        !empty($_POST["description"]) ? $swimLevel->setDescription($_POST["description"]) : $errors["description"] = "Description was empty";
        !empty($_POST["requirements"]) ? $swimLevel->setRequirements($_POST["requirements"]) : $errors["requirements"] = "Requirements was empty";
        !empty($_POST["ageRange"]) ? $swimLevel->setAgeRange($_POST["ageRange"]) : $errors["ageRange"] = "Age Range was empty";

        if (count($errors) !== 0) {
            return new Response('Errors are: ' . var_dump($errors));
        }

        $sl = $swimLevelsRepository->getLastProgression();
        //TODO - getLastProgression returns an array of an array, to get the max progression
        //use $sl[0]["progression"]
        $swimLevel->setProgression($sl[0]["progression"] + 1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($swimLevel);
        $em->flush();

        return $this->redirectToRoute('swim_levels_index');
    }
//    public function new(Request $request): Response
//    {
//        $swimLevel = new SwimLevels();
//        $form = $this->createForm(SwimLevelsType::class, $swimLevel);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($swimLevel);
//            $em->flush();
//
//            return $this->redirectToRoute('swim_levels_index');
//        }
//
//        return $this->render('swim_levels/new.html.twig', [
//            'swim_level' => $swimLevel,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="swim_levels_show", methods="GET")
     */
    public function show(SwimLevels $swimLevel): Response
    {
        return $this->render('swim_levels/show.html.twig', ['swim_level' => $swimLevel]);
    }

    /**
     * @Route("/{id}/edit", name="swim_levels_edit", methods="GET|POST")
     */
    public function edit(Request $request, SwimLevels $swimLevel): Response
    {
        $form = $this->createForm(SwimLevelsType::class, $swimLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('swim_levels_edit', ['id' => $swimLevel->getId()]);
        }

        return $this->render('swim_levels/edit.html.twig', [
            'swim_level' => $swimLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="swim_levels_delete", methods="DELETE")
     */
    public function delete(Request $request, SwimLevels $swimLevel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$swimLevel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($swimLevel);
            $em->flush();
        }

        return $this->redirectToRoute('swim_levels_index');
    }

    /**
     * @Route("/{id}/raise", name="swim_levels_raise_progression", methods="GET|POST")
     */
    public function raiseProgression(Request $request, SwimLevels $swimLevel): Response
    {
        $nextProgression = $swimLevel->getProgression() + 1;
        $nextSwimLevel = $this->getDoctrine()
            ->getRepository(SwimLevels::class)
            ->findOneBy(['progression' => $nextProgression]);

        $nextSwimLevel->setProgression($swimLevel->getProgression());
        $swimLevel->setProgression(999);

        $em = $this->getDoctrine()->getManager();
        $em->persist($swimLevel);
        $em->persist($nextSwimLevel);
        $em->flush();

        $swimLevel->setProgression($nextProgression);
        $em->persist($swimLevel);
        $em->flush();

        return $this->redirectToRoute('swim_levels_index');
    }

    /**
     * @Route("/{id}/lower", name="swim_levels_lower_progression", methods="GET|POST")
     */
    public function lowerProgression(Request $request, SwimLevels $swimLevel): Response
    {
        $prevProgression = $swimLevel->getProgression() - 1;
        $prevSwimLevel = $this->getDoctrine()
            ->getRepository(SwimLevels::class)
            ->findOneBy(['progression' => $prevProgression]);

        $prevSwimLevel->setProgression($swimLevel->getProgression());
        $swimLevel->setProgression(999);

        $em = $this->getDoctrine()->getManager();
        $em->persist($swimLevel);
        $em->persist($prevSwimLevel);
        $em->flush();

        $swimLevel->setProgression($prevProgression);
        $em->persist($swimLevel);
        $em->flush();

        return $this->redirectToRoute('swim_levels_index');
    }
}
