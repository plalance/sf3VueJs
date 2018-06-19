<?php

namespace CommunicationBundle\Controller\API;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Swagger\Annotations as SWG;

class MailApiController extends Controller
{

    /**
     * Envoyer un mail via l'API
     * User doit être loggué sinon retourne une erreur Json
     * @SWG\Response(
     *     response=200,
     *     description="Send Email",
     * )
     * @SWG\Parameter(
     *     name="content",
     *     in="query",
     *     type="string",
     *     description="content (POST) will be used for the body of the mail"
     * )
     * @SWG\Tag(name="Mail")
     */
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
            $filePAth = $request->server->get('DOCUMENT_ROOT') . '/uploads/bf5.pdf';

            $template = $this->renderView('CommunicationBundle::mail.html.twig', [
                'content' => $postContent
            ]);

            $email = new PHPMailer();
            $email->isHTML(true);
            $email->From = 'mol.sf2devveloper@gmail.com';
            $email->FromName = 'Message MailApi';
            $email->Subject = 'Super Objet';
            $email->Body = $template;
            $email->AddAddress('lalance.paul@gmail.com');
            try {
                $email->AddAttachment($filePAth, 'bf5.pdf');
                $email->Send();
            } catch (Exception $e) {
            }

        } else {
            return $this->json("Vous n'êtes pas connectés, pas d'accès à l'API");
        }
        return new Response($postContent);
    }
}
