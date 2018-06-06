<?php

namespace UserBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class UserApiController extends Controller
{
    /**
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     */
    public function infosAction(User $user){
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($user, "json"));
    }

    /**
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     */
    public function notifyAdminAction(Request $request, User $user){
        $response = "ERREUR";
        if($method = $request->query->has('method') and $request->query->get('method')=="email"){
            $user->sendNotificationByEmail($request->query->get('content'));
            $response = "Message envoyé;";
        }
        $serializer = $this->get('jms_serializer');
        return $this->json($response);
    }
}
