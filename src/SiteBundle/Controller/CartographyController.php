<?php

namespace SiteBundle\Controller;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SiteBundle\Entity\Event;
use SiteBundle\Entity\Location;
use SiteBundle\Form\EventType;
use SiteBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Swagger\Annotations as SWG;

class CartographyController extends Controller
{
    public function indexAction(Request $request)
    {
        $event = new Event();
        $formEvent = $this->createForm(EventType::class, $event, array());
        $formEvent->handleRequest($request);

        $location = new Location();
        $formLocation = $this->createForm(LocationType::class, $location, array());

        if ($formEvent->isSubmitted() && $formEvent->isValid()) {

            $event->setName($formEvent->get('name')->getData());
            $event->setLocation($formEvent->get('location')->getData());
            $event->setIcon($formEvent->get('icon')->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('cartography');
        }

        return $this->render('SiteBundle:Cartography:index.html.twig', [
            'formEvent' => $formEvent->createView(),
            'formLocation' => $formLocation->createView(),
        ]);
    }

    /**
     * Page d'un Event
     * @ParamConverter("event", options={"mapping": {"event_id": "id"}})
     */
    public function eventAction(Event $event)
    {
        return $this->render('SiteBundle:Cartography:event.html.twig', [
            'event' => $event
        ]);
    }
}