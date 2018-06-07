<?php

namespace SiteBundle\Controller\API;

use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SiteBundle\Entity\Sample;
use SiteBundle\Form\SampleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use UserBundle\Entity\User;

class SampleApiController extends Controller
{
    /**
     * @ParamConverter("sample", options={"mapping": {"sample_id": "id"}})
     */
    public function infosAction(Sample $sample){
        $serializer = $this->get('jms_serializer');
        return $this->json($serializer->serialize($sample, "json"));
    }


    /**
     * @ParamConverter("sample", options={"mapping": {"sample_id": "id"}})
     */
    public function updateAction(Request $request, Sample $sample)
    {
//        $serializer = $this->get('jms_serializer');
//        return $this->json($serializer->serialize($sample, "json"));
//        $sampleUpdate = $request->request->get('sampleUpdate');
//        return 'toto';
        return $this->updateSample($request,true);
    }

    public function updateSample(Request $request, $clearMissing){

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
