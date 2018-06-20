<?php

namespace SiteBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SiteBundle\Entity\Sample;
use SiteBundle\Form\SampleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Swagger\Annotations as SWG;

class LocationApiController extends Controller
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
    public function listAction()
    {
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
}
