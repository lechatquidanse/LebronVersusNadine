<?php

namespace LCQD\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * DefaultController
 * 
 * @author lechatquidanse
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="lcqd_app_homepage")
     */
    public function indexAction()
    {
        $avatar = $this->container->get('lcqd_playstation.avatar.manager')->getOneRandom();
        
        return $this->render('lcqd/app/index.html.twig');
    }
}
