<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableType;
use App\Repository\ResponsableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/responsable")
 */
class ResponsableController extends AbstractController
{
    /**
     * @Route("/", name="responsable_index", methods={"GET"})
     */
    public function index(ResponsableRepository $responsableRepository): Response
    {
        return $this->render('responsable.html.twig');
    }

    /**
     * @Route("/new", name="responsable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $responsable = new Responsable();
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($responsable);
            $entityManager->flush();

            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/new.html.twig', [
            'responsable' => $responsable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="responsable_show", methods={"GET"})
     */
    public function show(Responsable $responsable): Response
    {
        return $this->render('responsable/show.html.twig', [
            'responsable' => $responsable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="responsable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Responsable $responsable): Response
    {
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsable_index');
        }

        return $this->render('responsable/edit.html.twig', [
            'responsable' => $responsable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="responsable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Responsable $responsable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$responsable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($responsable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('responsable_index');
    }
}
