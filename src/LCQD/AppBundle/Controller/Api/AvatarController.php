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
use LCQD\Playstation\Bundle\Model\AvatarInterface;

/**
 * AvatarController
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
     *   output = "AvatarInterface",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the avatar is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *     templateVar="avatar",
     *     template="lcqd/app/api/avatar/getAvatar.html.twig"
     * )
     *
     * @param int     $id      the page id
     *
     * @return AvatarInterface
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function getAvatarAction($id)
    {
        $avatar = $this->getOr404($id);

        return $avatar;
    }

    /**
     * Fetch an AvatarInterface or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return AvatarInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($avatar = $this->container->get('lcqd_playstation.avatar.manager')->get($id))) {
            throw new NotFoundHttpException(sprintf('The avatar \'%s\' was not found.', $id));
        }
        
        return $avatar;
    }
}
