<?php


namespace App\Controller;


class LoginController
{
    /**
     * @Route("/login", name="login", methods={"GET","POST"})
     * @return Response
     */

    public function loginAction(Request $request ): Response
    {

        $utilisateur = new Utilisateur();
        $form = $this->createFormBuilder($utilisateur)
            ->add('username',TextRole::class)
            ->add('password',PasswordRole::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $password = $utilisateur->getPass();
            $username = $utilisateur->getMail();
            $id = $utilisateur->getId();
            $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
            $utilisateur1 = $repository->findOneBy(array('username'=>$username,'password'=>$password));
            if(!$utilisateur1)
            {
                $this->addFlash('fail', 'Please check your username and password !!');
            }
            else {
                if ($utilisateur1->getRole() == 'admin') { return $this->redirectToRoute('admin',['id' =>$utilisateur1->getId()]);}

                if ($utilisateur1->getRole() == 'etudiant') { return $this->redirectToRoute('etudiant',['id' =>$utilisateur1->getId()]);}

                if ($utilisateur1->getRole() == 'responsable') {return $this->redirectToRoute('responsable',['id' =>$utilisateur1->getId()]);}

                if ($utilisateur1->getRole() == 'utilisateur'){return $this->redirectToRoute('utilisateur',['id' =>$utilisateur1->getId()]);}}
        }
        return $this->render('login.html.twig',['utilisateur' => $utilisateur, 'form'=>$form->createView()] );
    }


//les fonctions des interfaces

//Fonction 1 -------------------------- Admin
    /**
     * @Route("/admin/{id}", name="admin", methods={"GET","POST"}))
     * @return Response
     */
    public function AdminAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('admin /index.html.twig' , ['utilisateur' => $utilisateur1,]);
    }

//Fonction 2 -------------------------- Etudiant
    /**
     * @Route("/etudiant/{id}", name="etudiant", methods={"GET","POST"}))
     * @return Response
     */
    public function EtudiantAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('etudiant/index.html.twig' , ['utilisateur' => $utilisateur1,]);
    }
//Fonction 3 ------------------------- Responsable

    /**
     * @Route("/responsable/{id}", name="responsable", methods={"GET","POST"}))
     * @return Response
     */
    public function ResponsableAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('responsable/index.html.twig' , [ 'utilisateur' => $utilisateur1,]);}


//Fonction 4 ------------------------- Utilisateur

        /**
     * @Route("/utilisateur/{id}", name="utilisateur", methods={"GET","POST"}))
     * @return Response
     */
        public function UtilisateurAction(Utilisateur $utilisateur1): Response
    {
        return $this->render('utilisateur/index.html.twig' , [ 'utilisateur' => $utilisateur1, ]);
    }

}