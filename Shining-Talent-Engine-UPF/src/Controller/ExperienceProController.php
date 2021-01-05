<?php

namespace App\Controller;

use App\Entity\ExperiencePro;
use App\Form\ExperienceProType;
use App\Repository\ExperienceProRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/experience/pro")
 */
class ExperienceProController extends AbstractController
{
    /**
     * @Route("/", name="experience_pro_index", methods={"GET"})
     */
    public function index(ExperienceProRepository $experienceProRepository): Response
    {
        return $this->render('experience_pro/index.html.twig', [
            'experience_pros' => $experienceProRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="experience_pro_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $experiencePro = new ExperiencePro();
        $form = $this->createForm(ExperienceProType::class, $experiencePro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($experiencePro);
            $entityManager->flush();

            return $this->redirectToRoute('experience_pro_index');
        }

        return $this->render('experience_pro/new.html.twig', [
            'experience_pro' => $experiencePro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experience_pro_show", methods={"GET"})
     */
    public function show(ExperiencePro $experiencePro): Response
    {
        return $this->render('experience_pro/show.html.twig', [
            'experience_pro' => $experiencePro,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="experience_pro_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ExperiencePro $experiencePro): Response
    {
        $form = $this->createForm(ExperienceProType::class, $experiencePro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experience_pro_index');
        }

        return $this->render('experience_pro/edit.html.twig', [
            'experience_pro' => $experiencePro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experience_pro_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ExperiencePro $experiencePro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experiencePro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($experiencePro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('experience_pro_index');
    }
}
