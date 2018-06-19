<?php

namespace SiteBundle\Controller;

use JMS\Serializer\SerializationContext;
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
}