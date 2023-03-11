<?php

namespace App\UI\Web\Controller;

use App\UI\Web\Form\RegisterForm;
use App\UI\Web\Form\RegisterFormDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/register', name: "security_register")]
    public function registerAction() : Response
    {
        $formDto = new RegisterFormDto();
        $form = $this->createForm(RegisterForm::class, $formDto);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/login', name: "security_login")]
    public function loginAction()
    {

    }

    #[Route('/logout', name: "security_logout")]
    public function logoutAction()
    {

    }
}