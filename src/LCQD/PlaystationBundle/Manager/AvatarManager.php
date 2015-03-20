<?php

namespace LCQD\PlaystationBundle\Manager;

use LCQD\Component\Manager\BaseManager;
use LCQD\PlaystationBundle\Model\AvatarInterface;
use LCQD\PlaystationBundle\Form\AvatarType;

/**
 * AvatarManager
 * 
 * @author lechatquidanse
 */
class AvatarManager extends BaseManager implements AvatarManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOneRandom()
    {
        return $this->getRepository()->getOneRandom();
    }

    /**
     * {@inheritDoc}
     */
    public function createForm()
    {
        return $this->formFactory->create(new AvatarType());
    }

    /**
     * Create a new Avatar.
     *
     * @param array $parameters
     *
     * @return PageInterface
     */
    public function post(array $parameters)
    {
        $avatar = $this->create();

        return $this->processForm($avatar, $parameters, 'POST');
    }

    /**
     * Processes the form.
     *
     * @param AvatarInterface   $page
     * @param array             $parameters
     * @param String            $method
     *
     * @return AvatarInterface
     *
     * @throws \Exception
     */
    private function processForm(AvatarInterface $avatar, array $parameters, $method = "PUT")
    {
        $avatarType = new AvatarType();
        $avatarTypeName = $avatarType->getName();
        $avatarFormParameters = isset($parameters[$avatarTypeName]) ? $parameters[$avatarTypeName] : null;
        
        if ($avatarFormParameters) {
            $form = $this->formFactory->create($avatarType, $avatar, array('method' => $method));
            $form->submit($avatarFormParameters, 'PATCH' !== $method);

            if ($form->isValid()) {
                $avatar = $form->getData();
                $this->persistAndFlush($avatar);

                return $avatar;
            }
        }

        var_dump($form->getErrors());die;

        throw new \Exception('Invalid submitted data', /*$form*/ 1);
    }
}
