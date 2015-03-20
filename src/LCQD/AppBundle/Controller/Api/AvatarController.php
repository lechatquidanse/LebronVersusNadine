<?php

namespace LCQD\AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormTypeInterface;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use LCQD\Playstation\Bundle\Entity\Avatar;
use LCQD\PlaystationBundle\Manager\AvatarManagerInterface;

/**
 * AvatarController
 * 
 * @Annotations\Prefix("/v1")
 * @Annotations\NamePrefix("api_1_")
 * 
 * @author lechatquidanse
 */
class AvatarController extends FOSRestController
{
    /**
     * Get single Avatar.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets an Avatar for a given id",
     *   output = "Avatar",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the avatar is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *     templateVar="avatar",
     *     template="lcqd/app/api/avatar/get.html.twig"
     * )
     *
     * @param int     $id      the page id
     *
     * @return Avatar
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function getAvatarAction($id)
    {
        $avatar = $this->getOr404($id);

        return $avatar;
    }

    /**
     * Presents the form to use to create a new avatar.
     *
     * @ApiDoc(
     *     resource = true,
     *     statusCodes = {
     *         200 = "Returned when successful"
     *         }
     * )
     *
     * @Annotations\View(
     *     templateVar = "form",
     *     template="lcqd/app/api/avatar/new.html.twig"
     * )
     *
     * @return FormTypeInterface
     */
    public function newAvatarAction()
    {
        return $this->getAvatarManager()->createForm();
    }

    /**
     * Create an Avatar from the submitted data.
     *
     * @ApiDoc(
     *       resource = true,
     *       description = "Creates a new page from the submitted data.",
     *       input = "LCQD\PlaystationBundle\Form\AvatarType",
     *       statusCodes = {
     *           200 = "Returned when successful",
     *           400 = "Returned when the form has errors"
     *           }
     * )
     *
     * @Annotations\View(
     *     templateVar = "form",
     *     template="lcqd/app/api/avatar/new.html.twig"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postAvatarAction(Request $request)
    {
        try {
            $avatar = $this->getAvatarManager()->post(
                $request->request->all()
            );
            $routeOptions = array(
                'id' => $avatar->getId(),
                '_format' => $request->get('_format')
            );
            return $this->routeRedirectView('api_1_get_avatar', $routeOptions, Codes::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Get Avatar manager
     * 
     * @return LCQD\PlaystationBundle\Manager\AvatarManagerInterface
     */
    protected function getAvatarManager()
    {
        if (!$this->container->get('lcqd_playstation.avatar.manager') instanceof AvatarManagerInterface) {
            throw new \Exception("AvatarManager is not implemented LCQD\PlaystationBundle\Manager\AvatarManagerInterface", 1);
        }

        return $this->container->get('lcqd_playstation.avatar.manager');
    }

    /**
     * Fetch an Avatar or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return Avatar
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($avatar = $this->getAvatarManager()->get($id))) {
            throw new NotFoundHttpException(sprintf('The avatar \'%s\' was not found.', $id));
        }
        
        return $avatar;
    }
}
