<?php

namespace SiteBundle\Controller;

use JMS\Serializer\SerializationContext;
use SiteBundle\Entity\Event;
use SiteBundle\Entity\Location;
use SiteBundle\Form\EventType;
use SiteBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Swagger\Annotations as SWG;

class CartographyController extends Controller
{
    /**
     * Liste de toutes les localisations, avec leurs events associés
     * @SWG\Response(
     *     response=200,
     *     description="Returns serialized DoctrineCollection of Locations",
     * )
     * @SWG\Tag(name="Localisations")
     *
     **/
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        // Get all locations
        $locations = $this->getDoctrine()
            ->getRepository('SiteBundle:Location')
            ->findAll();
        // Context application + serialisation
        $ctx = SerializationContext::create()->setGroups(array('application'));
        $ctx->setSerializeNull(true);
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($locations, "json", $ctx));
    }


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
}