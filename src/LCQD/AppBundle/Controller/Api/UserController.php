<?php

namespace LCQD\AppBundle\Controller\Api;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * UserController
 * 
 * @Annotations\Prefix("/v1")
 * @Annotations\NamePrefix("api_1_")
 * 
 * @author lechatquidanse
 */
class UserController extends FOSRestController
{
    /**
     * Get Me.
     *
     * @ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         200 = "Returned when successful"
     *     }
     * )
     * 
     * @Annotations\View(
     *     templateVar="user",
     *     template="lcqd/app/api/user/getMe.html.twig"
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
