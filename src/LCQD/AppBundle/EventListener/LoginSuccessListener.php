<?php

namespace LCQD\AppBundle\Listener;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

/**
 * LoginSuccessListener
 * 
 * @author lechatquidanse
 */
class LoginSuccessListener implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $security;

    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    /*public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        try {
            $user = $this->security->getToken()->getUser();

            if ($user->hasRole('ROLE_API_USER') && $user->getEnabledAvatar()) {

                $user
            }
        } catch (Exception $e) {
            
        }
        if (->isGranted('ROLE_SUPER_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('category_index'));
        } else {
            // redirect the user to where they were before the login process begun.
            $referer_url = $request->headers->get('referer');
            $response = new RedirectResponse($referer_url);
        }

        return $response;
    }*/
}
