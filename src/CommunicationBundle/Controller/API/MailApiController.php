<?php

namespace CommunicationBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class MailApiController extends Controller
{

    public function sendEmailAction(Request $request)
    {
//        $mailer = $this->get('mailer');
//
//        $message = (new \Swift_Message('Message custom'))
//            ->setFrom('lalance.paul@gmail.com')
//            ->setTo('lalance.paul@gmail.com')
//            ->setBody(
//                $this->renderView(
//                // app/Resources/views/Emails/registration.html.twig
//                    'CommunicationBundle::mail.html.twig',
//                    array('content' => "toto")
//                ),
//                'text/html'
//            )
//            /*
//             * If you also want to include a plaintext version of the message
//            ->addPart(
//                $this->renderView(
//                    'Emails/registration.txt.twig',
//                    array('name' => $name)
//                ),
//                'text/plain'
//            )
//            */;

        $postContent = $request->request->get('content');

        if ($this->getUser()) {
            $template = $this->renderView('CommunicationBundle::mail.html.twig', [
                'content' => $postContent
            ]);
            ini_set('display_errors', 1);

            error_reporting(E_ALL);
            $to = "lalance.paul@gmail.com";

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: test@votredomaine.com\r\n"."X-Mailer: php";
            $subject = "Message de l'administrateur";
            $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"";
            mail($to, $subject, $template, $headers);
        } else {
            return $this->json("Vous n'êtes pas connectés, pas d'accès à l'API");
        }
        return new Response($postContent);
    }
}
