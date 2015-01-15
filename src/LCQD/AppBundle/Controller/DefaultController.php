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
        $users = $this->container->get('fos_user.user_manager')->findUsers();
        var_dump($users);
        return $this->render('LCQDAppBundle:Default:index.html.twig');
    }
}
