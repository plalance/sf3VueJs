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

class SampleApiController extends Controller
{
    /**
     * Récupère les informations d'un Sample
     * @SWG\Response(
     *     response=200,
     *     description="Returns serialized Sample",
     * )
     * @SWG\Parameter(
     *     name="sample_id",
     *     in="query",
     *     type="integer",
     *     description="sample_id is used by Symfony ParamConverter to query the Sample"
     * )
     *
     * @ParamConverter("sample", options={"mapping": {"sample_id": "id"}})
     * @SWG\Tag(name="Sample")
     */
    public function infosAction(Sample $sample){
        $ctx = SerializationContext::create()->setGroups(array('admin'));
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($sample, "json", $ctx));
    }

    /**
     * Mettre à jou run sample (requete POST)
     * @SWG\Response(
     *     response=200,
     *     description="Update Sample",
     * )
     * @SWG\Parameter(
     *     name="sample_id",
     *     in="query",
     *     type="integer",
     *     description="sample_id is used by Symfony ParamConverter to query the Sample"
     * )
     * @ParamConverter("sample", options={"mapping": {"sample_id": "id"}})
     * @SWG\Tag(name="Sample")
     */
    public function updateAction(Request $request, Sample $sample)
    {
        return $this->updateSample($request,false);
    }

    public function updateSample(Request $request, $clearMissing)
    {
        $sample = $this->get('doctrine.orm.entity_manager')
            ->getRepository('SiteBundle:Sample')
            ->find($request->get('sample_id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $sample Sample */

        $form = $this->createForm(SampleType::class, $sample);
        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            // l'entité vient de la base, donc le merge n'est pas nécessaire.
            // il est utilisé juste par soucis de clarté
            $em->merge($sample);
            $em->flush();
            return new Response("BON");
        } else {
            return new Response($this->json($request->request->all()));
        }
    }
}
