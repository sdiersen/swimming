<?php

namespace App\Controller;

use App\Entity\SwimInstructors;
use App\Form\SwimInstructorsType;
use App\Repository\SwimInstructorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/swim/instructors")
 */
class SwimInstructorsController extends AbstractController
{
    /**
     * @Route("/", name="swim_instructors_index", methods="GET")
     */
    public function index(SwimInstructorsRepository $swimInstructorsRepository): Response
    {
        return $this->render('swim_instructors/index.html.twig', ['swim_instructors' => $swimInstructorsRepository->findAll()]);
       // return $this->rendersw('swim_instructors/index.html.twig', ['swim_instructors' => $swimInstructorsRepository->findAllOrderByProgression()]);

    }

    /**
     * @Route("/new", name="swim_instructors_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $swimInstructor = new SwimInstructors();
        $form = $this->createForm(SwimInstructorsType::class, $swimInstructor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($swimInstructor);
            $em->flush();

            return $this->redirectToRoute('swim_instructors_index');
        }

        return $this->render('swim_instructors/new.html.twig', [
            'swim_instructor' => $swimInstructor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="swim_instructors_show", methods="GET")
     */
    public function show(SwimInstructors $swimInstructor): Response
    {
        return $this->render('swim_instructors/show.html.twig', ['swim_instructor' => $swimInstructor]);
    }

    /**
     * @Route("/{id}/edit", name="swim_instructors_edit", methods="GET|POST")
     */
    public function edit(Request $request, SwimInstructors $swimInstructor): Response
    {
        $form = $this->createForm(SwimInstructorsType::class, $swimInstructor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('swim_instructors_edit', ['id' => $swimInstructor->getId()]);
        }

        return $this->render('swim_instructors/edit.html.twig', [
            'swim_instructor' => $swimInstructor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="swim_instructors_delete", methods="DELETE")
     */
    public function delete(Request $request, SwimInstructors $swimInstructor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$swimInstructor->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($swimInstructor);
            $em->flush();
        }

        return $this->redirectToRoute('swim_instructors_index');
    }
}
