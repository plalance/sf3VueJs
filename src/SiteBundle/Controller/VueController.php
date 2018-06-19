<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VueController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiteBundle:Vue:index.html.twig');
    }
}
