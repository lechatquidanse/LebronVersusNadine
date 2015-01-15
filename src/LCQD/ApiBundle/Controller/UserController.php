<?php

namespace LCQD\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * 
 */
class UserController extends FOSRestController
{
    /**
     * Get Me.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar="user"
     * )
     *
     * @param Request               $request      the request object
     *
     * @throws NotFoundHttpException when user not exist
     * 
     * @return UserInterface
     */
    public function getMeAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $user;
    }
}
