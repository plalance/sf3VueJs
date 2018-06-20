<?php

namespace SiteBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SiteBundle\Entity\Event;
use SiteBundle\Entity\Sample;
use SiteBundle\Form\SampleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Swagger\Annotations as SWG;

class EventApiController extends Controller
{
    /**
     *
     * Récupère les informations d'un évènement, avec son id en paramètre
     * @SWG\Response(
     *     response=200,
     *     description="Returns one event"
     * )
     * @SWG\Tag(name="Event")
     *
     *
     * @ParamConverter("event", options={"mapping": {"event_id": "id"}})
     */
    public function infosAction(Request $request, Event $event)
    {
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($event, "json"));
    }
}
