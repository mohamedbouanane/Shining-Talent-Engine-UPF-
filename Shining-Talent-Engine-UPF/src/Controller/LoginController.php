<?php


namespace App\Controller;

use App\Entity\User;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
        $utilisateur = new User();
        $form = $this->createFormBuilder($utilisateur)
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $password = $utilisateur->getPassword();
            $email = $utilisateur->getUsername();
            $id = $utilisateur->getId();
            $repository = $this->getDoctrine()->getRepository(User::class);
            $utilisateur1 = $repository->findOneBy(array('username'=>$email,'password'=>$password));
            if(!$utilisateur1)
            {
                $this->addFlash('fail', 'Please check your username and password !!');
            }
            else {

                if ($utilisateur1->getRoles() == 'Admin') {

                    return $this->redirectToRoute('admin',['id' =>$utilisateur1->getId()]);
                }

                if ($utilisateur1->getRoles() == 'Responsable') {

                    return $this->redirectToRoute('responsable',['id' =>$utilisateur1->getId()]);
                }

                if ($utilisateur1->getType() == 'Etudiant'){

                    return $this->redirectToRoute('etudiant',['id' =>$utilisateur1->getId()]);
                }}
        }
        return $this->render('authentification.html.twig',[
                'user' => $utilisateur,
                'form'=>$form->createView()]
        );
    }

    /**
     * @Route("/menu", name="menu", methods={"GET"})
     * @return Response
     */

    public function MenuAction(Request $request ): Response
    {
        return $this->render('menu.html.twig');
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