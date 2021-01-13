<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="pageAccueil", methods={"GET","POST"})
     */
    public function pageAccueil(): Response
    {
        return $this->render('pageAccueil.html.twig');
    }
    /**
     * @Route("/utilisateur/", name="utilisateur_index", methods={"GET"})
     */
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('login/index.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
        ]);
    }

    //--------------------------Les CRUDs

    /**
     * @Route("/utilisateur/new", name="utilisateur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/utilisateur/{id}/edit", name="utilisateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Utilisateur $utilisateur): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilisateur_index');
        }

        return $this->render('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="utilisateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Utilisateur $utilisateur): Response
    {
        if ($this->isCsrfTokenValid('delete' . $utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }
        return $this->redirectToRoute('utilisateur_index');
    }
    //--------------------------phase d'authentification et la verification des roles

    /**
     * @Route("/utilisateur/login", name="login", methods={"GET","POST"})
     * @return Response
     */
    public function loginAction(Request $request): Response
    {
        $utilisateur = new Utilisateur();

        $form = $this->createFormBuilder($utilisateur)
            ->add('mail', TextType::class)
            ->add('password', PasswordType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $password = $utilisateur->getPassword();
            $mail = $utilisateur->getMail();
            $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
            $utilisateur1 = $repository->findOneBy(array('mail' => $mail, 'password' => $password));

            if (!$utilisateur1) {

                $this->addFlash('fail', 'Please check your username and password !!');
            } else {
                if ($utilisateur1->getRole() == 'admin') {

                    return $this->redirectToRoute('admin', ['id' => $utilisateur1->getId()]);
                }

                if ($utilisateur1->getRole() == 'etudiant') {

                    return $this->redirectToRoute('etudiant', ['id' => $utilisateur1->getId()]);
                }

                if ($utilisateur1->getRole() == 'responsable') {

                    return $this->redirectToRoute('responsable', ['id' => $utilisateur1->getId()]);

                }
                return $this->render('login.html.twig', ['utilisateur' => $utilisateur, 'form' => $form->createView()]);
            }
        }
    }

    //--------------------------Page admin
    /**
     * @Route("/utilisateur/admin/{id}", name="admin", methods={"GET","POST"}))
     * @return Response
     */
    public function AdminAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('admin/index.html.twig' , ['utilisateur' => $utilisateur1,]);
    }
    //-------------------------- Page etudiant
    /**
     * @Route("/utilisateur/etudiant/{id}", name="etudiant", methods={"GET","POST"}))
     * @return Response
     */
    public function EtudiantAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('etudiant/index.html.twig' , ['utilisateur' => $utilisateur1,]);
    }

    //------------------------- Page responsable
    /**
     * @Route("/utilisateur/responsable/{id}", name="responsable", methods={"GET","POST"}))
     * @return Response
     */
    public function ResponsableAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('responsable/index.html.twig' , ['utilisateur' => $utilisateur1,]);
    }
}
