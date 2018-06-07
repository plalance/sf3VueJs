<?php

namespace UserBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class UserApiController extends Controller
{
    /**
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     */
    public function infosAction(User $user)
    {
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($user, "json"));
    }

    /**
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     */
    public function notifyAdminAction(Request $request, User $user)
    {
        $response = "ERREUR";
        if ($method = $request->query->has('method') and $request->query->get('method') == "email") {
            $user->sendNotificationByEmail($request->query->get('content'));
            $response = "Message envoyé;";
        }
        $serializer = $this->get('jms_serializer');
        return $this->json($response);
    }

    public function listAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findBy(array(), array('username' => 'desc'));

        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($users, "json"));
    }

    /**
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     */
    public function usurpateAction(Request $request, User $user)
    {

        if (!$user) {
            throw $this->createNotFoundException('No user found');
        }

        $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        $this->get('session')->set('_security_main', serialize($token));

        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($user, "json"));
    }

    public function logoutAction(Request $request)
    {

        $token = new AnonymousToken('main', 'anon.');

        $this->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();

        $response = new RedirectResponse($this->generateUrl('homepage_vue', array(
            'token' => $token
        )));

//        // Clearing the cookies.
//        $cookieNames = [
//            $this->container->getParameter('session.name'),
//            $this->container->getParameter('session.remember_me.name'),
//        ];
//        foreach ($cookieNames as $cookieName) {
//            $response->headers->clearCookie($cookieName);
//        }
        return $this->json("disconnected");
    }

    public function updateAction(Request $request)
    {
//        $serializer = $this->get('jms_serializer');
//        return $this->json($serializer->serialize($sample, "json"));
//        $sampleUpdate = $request->request->get('sampleUpdate');
//        return 'toto';
        return $this->updateUser($request, false);
    }

    public function updateUser(Request $request, $clearMissing)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername('paul');

//        /$form = $this->createForm(UserType::class, $user);
//        $form->submit($request->request->all(), $clearMissing);
//        if ($form->isValid()) {
//            $this->get('fos_user.user_manager')->updateUser($user, true);
//            // make more modifications to the database
//            $this->getDoctrine()->getManager()->flush();
//            return "toto";
//        } else {
//            return new  Response(json_encode($form));
//        }
//        $em = $this->getDoctrine()->getManager();
//        $em->($user);
//        $em->flush();
        return new Response(json_encode([$request->get('user_id'), $this->json($user),$request->request->all()]));
    }
}
