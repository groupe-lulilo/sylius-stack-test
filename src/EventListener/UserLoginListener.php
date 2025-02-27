<?php

    namespace App\EventListener;

    use Symfony\Component\Security\Core\Event\AuthenticationEvent;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Mailer\MailerInterface;
    use Symfony\Component\Mime\Email;
    use Twig\Environment;

    class UserLoginListener
    {
        private MailerInterface $mailer;
        private Environment $twig;

        public function __construct(MailerInterface $mailer, Environment $twig)
        {
            $this->mailer = $mailer;
            $this->twig = $twig;
        }

        public function onLogin(AuthenticationEvent $event): void
        {
            $user = $event->getAuthenticationToken()->getUser();

            // Si l'utilisateur est un objet User
            if ($user) {
                $this->sendLoginEmail($user->getEmail());
            }
        }

        private function sendLoginEmail(string $toEmail): void
        {
            $email = (new Email())
                ->from('no-reply@lulilo.fr')
                ->to($toEmail)
                ->subject('Connexion réussie')
                ->html(
                    $this->twig->render('emails/login_success.html.twig', [
                        'email' => $toEmail,
                    ])
                );

            $this->mailer->send($email);
        }

    }
