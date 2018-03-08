<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SampleController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteBundle:samples:index.html.twig');
    }
}
