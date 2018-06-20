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

class LocationController extends Controller
{
    public function createAction(Request $request)
    {
        $loc = new Location();
        $form = $this->createForm(LocationType::class, $loc, array());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loc->setName($form->get('name')->getData());
            $loc->setLatitude($form->get('latitude')->getData());
            $loc->setLongitude($form->get('longitude')->getData());
            $loc->setIconForGoogleMap($form->get('iconForGoogleMap')->getData());
            $loc->setAddressName($form->get('addressName')->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($loc);
            $em->flush();
            return $this->redirectToRoute('cartography');
        }
    }

    /**
     * Page d'une location
     * @ParamConverter("location", options={"mapping": {"location_id": "id"}})
     */
    public function editAction(Request $request, Location $location)
    {
        $form = $this->createForm(LocationType::class, $location, array());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $location->setName($form->get('name')->getData());
            $location->setLatitude($form->get('latitude')->getData());
            $location->setLongitude($form->get('longitude')->getData());
            $location->setIconForGoogleMap($form->get('iconForGoogleMap')->getData());
            $location->setAddressName($form->get('addressName')->getData());

            $em = $this->getDoctrine()->getManager();
            $em->merge($location);
            $em->flush();
            return $this->redirectToRoute('cartography');
        }
        return $this->render('SiteBundle:Cartography:location_edit.html.twig', [
            'form' => $form->createView(),
            'object' => $location,
        ]);
    }

    /**
     * Suppression d'une location
     * @ParamConverter("location", options={"mapping": {"location_id": "id"}})
     */
    public function removeAction(Request $request, Location $location)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();
        return $this->redirectToRoute('list_location');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        // Get all locations
        $locations = $this->getDoctrine()
            ->getRepository('SiteBundle:Location')
            ->findAll();
        return $this->render('SiteBundle:Cartography:location_list.html.twig', [
            'locations' => $locations,
        ]);
    }
}