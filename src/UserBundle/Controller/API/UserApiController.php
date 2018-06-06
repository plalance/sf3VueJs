<?php

namespace UserBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
