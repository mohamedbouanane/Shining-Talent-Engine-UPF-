<?php


namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Choice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"GET","POST"})
     * @return Response
     */

    public function loginAction(Request $request ): Response
    {
        return $this->render('login.html.twig');
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