<?php

namespace App\Controller;

use App\Entity\CollectionProfiles;
use App\Form\CollectionProfilesType;
use App\Repository\CollectionProfilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collection/profiles")
 */
class CollectionProfilesController extends AbstractController
{
    /**
     * @Route("/", name="collection_profiles_index", methods={"GET"})
     */
    public function index(CollectionProfilesRepository $collectionProfilesRepository): Response
    {
        return $this->render('collection_profiles/index.html.twig', [
            'collection_profiles' => $collectionProfilesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="collection_profiles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $collectionProfile = new CollectionProfiles();
        $form = $this->createForm(CollectionProfilesType::class, $collectionProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($collectionProfile);
            $entityManager->flush();

            return $this->redirectToRoute('collection_profiles_index');
        }

        return $this->render('collection_profiles/new.html.twig', [
            'collection_profile' => $collectionProfile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collection_profiles_show", methods={"GET"})
     */
    public function show(CollectionProfiles $collectionProfile): Response
    {
        return $this->render('collection_profiles/show.html.twig', [
            'collection_profile' => $collectionProfile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="collection_profiles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CollectionProfiles $collectionProfile): Response
    {
        $form = $this->createForm(CollectionProfilesType::class, $collectionProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collection_profiles_index');
        }

        return $this->render('collection_profiles/edit.html.twig', [
            'collection_profile' => $collectionProfile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collection_profiles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CollectionProfiles $collectionProfile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collectionProfile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($collectionProfile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('collection_profiles_index');
    }
}
