<?php

namespace SiteBundle\Controller;

use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartographyController extends Controller
{
    public function listAction(){
        // Get all locations
        $locations = $this->getDoctrine()
            ->getRepository('SiteBundle:Location')
            ->findAll();

        // Context application + serialisation
        $ctx = SerializationContext::create()->setGroups(array('application'));
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($locations, "json", $ctx));
    }

    public function indexAction()
    {
        return $this->render('SiteBundle:Site:cartography.html.twig', [
        ]);
    }
}