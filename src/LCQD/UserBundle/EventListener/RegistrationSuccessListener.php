<?php

namespace LCQD\UserBundle\EventListener;

use Doctrine\ORM\NoResultException;
use LCQD\PlaystationBundle\Manager\AvatarManagerInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * RegistrationSuccessListener
 * Listener responsible to init account of user with ROLE_USER user
 *
 * @author lechatquidanse
 */
class RegistrationSuccessListener implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * [$avatarManager description]
     * @var AvatarManagerInterface
     */
    private $avatarManager;

    public function __construct(UrlGeneratorInterface $router, AvatarManagerInterface $avatarManager)
    {
        $this->router = $router;
        $this->avatarManager = $avatarManager;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        try {
            /** @var $user \LCQD\UserBundle\Entity\User */
            $user = $event->getForm()->getData();
            
            if ($user->hasRole('ROLE_API_USER')) {
                $avatar = $this->avatarManager->getOneRandom();
                $user->setAvatar($avatar);
            }
        } catch (NoResultException $e) {
            // No avatar found
            //$url = $this->router->generate('api_error');
            //$event->setResponse(new RedirectResponse($url));
        } catch (Exception $e) {
            // User exection
        }

    }
}
