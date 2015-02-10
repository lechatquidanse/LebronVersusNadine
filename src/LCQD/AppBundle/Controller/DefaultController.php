<?php

namespace LCQD\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * DefaultController
 * 
 * @author lechatquidanse
 */
class DefaultController extends Controller
{
    /**
     * [indexAction description]
     * @return [type] [description]
     */
    public function indexAction()
    {
        //$avatar = $this->container->get('lcqd_playstation.avatar.manager')->getOneRandom();
        //var_dump($avatar);die;
        return $this->render('LCQDAppBundle:Default:index.html.twig');
    }
}
