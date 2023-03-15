<?php

namespace App\UI\Web\Controller;

use App\Application\Exception\ApplicationException;
use App\Application\UseCase\RegisterUser;
use App\Shared\LoggerAwareTrait;
use App\UI\Web\Form\LoginForm;
use App\UI\Web\Form\LoginFormDto;
use App\UI\Web\Form\RegisterForm;
use App\UI\Web\Form\RegisterFormDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    use LoggerAwareTrait;
    private MessageBusInterface $commandBus;

    /**
     * @param MessageBusInterface $commandBus
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }


    #[Route('/register', name: "security_register")]
    public function registerAction(Request $request) : Response
    {
        $formDto = new RegisterFormDto();
        $form = $this->createForm(RegisterForm::class, $formDto);

        $form->handleRequest($request);
        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $command = new RegisterUser($formDto->email, $formDto->password);
                $this->commandBus->dispatch($command);
                return $this->redirectToRoute('security_registered');
            } catch (HandlerFailedException $e) {
                $previous = $e->getPrevious();
                if ($previous instanceof ApplicationException) {
                    $this->logger->info($previous->getMessage());
                    $error = $previous->getMessage();
                }
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    #[Route('/registered', name: "security_registered")]
    public function registeredAction(Request $request) : Response
    {
        return $this->render('security/registered.html.twig');
    }

    #[Route('/login', name: "security_login")]
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, new LoginFormDto($lastUsername, $this->generateUrl('homepage')));

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error?->getMessage()
        ]);
    }

    #[Route('/logout', name: "security_logout")]
    public function logoutAction(): Response
    {
        return new Response('');
    }
}