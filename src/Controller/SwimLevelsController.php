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
        return $this->render('swim_levels/index.html.twig', ['swim_levels' => $swimLevelsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="swim_levels_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $swimLevel = new SwimLevels();
        $form = $this->createForm(SwimLevelsType::class, $swimLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($swimLevel);
            $em->flush();

            return $this->redirectToRoute('swim_levels_index');
        }

        return $this->render('swim_levels/new.html.twig', [
            'swim_level' => $swimLevel,
            'form' => $form->createView(),
        ]);
    }

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
}
