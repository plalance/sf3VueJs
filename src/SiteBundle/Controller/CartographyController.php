<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartographyController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteBundle:Site:cartography.html.twig');
    }
}