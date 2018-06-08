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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

            $random_hash = md5(date('r', time()));
            $filePAth = $request->server->get('DOCUMENT_ROOT').'/uploads/bf5.pdf';

            $template = $this->renderView('CommunicationBundle::mail.html.twig', [
                'content' => $postContent
            ]);

            $email = new PHPMailer();
            $email->isHTML(true);
            $email->From      = 'mol.sf2devveloper@gmail.com';
            $email->FromName  = 'Message MailApi';
            $email->Subject   = 'Super Objet';
            $email->Body      = $template;
            $email->AddAddress( 'lalance.paul@gmail.com' );
            $email->AddAttachment( $filePAth , 'bf5.pdf' );
            $email->Send();
            
        } else {
            return $this->json("Vous n'êtes pas connectés, pas d'accès à l'API");
        }
        return new Response($postContent);
    }
}
