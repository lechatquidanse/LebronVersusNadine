<?php

namespace LCQD\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * 
 */
class DefaultController extends Controller
{
    /**
     * [indexAction description]
     * @return [type] [description]
     */
    public function indexAction()
    {
        return $this->render('LCQDAppBundle:Default:index.html.twig');
    }
}
