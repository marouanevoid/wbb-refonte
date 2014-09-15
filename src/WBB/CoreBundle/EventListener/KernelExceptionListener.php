<?php

namespace WBB\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use WBB\CoreBundle\RedirectUrl\UrlMatcher;

class KernelExceptionListener
{

    private $router;
    private $session;
    private $urlMatcher;

    public function __construct(RouterInterface $router, SessionInterface $session, UrlMatcher $urlMatcher)
    {
        $this->router = $router;
        $this->session = $session;
        $this->urlMatcher = $urlMatcher;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof HttpExceptionInterface) {
            if ($exception->getStatusCode() == 404) {
                $url = $event->getRequest()->getPathInfo();
                $matched = $this->urlMatcher->match($url);

                if ($matched) {
                    // redirect to the matched URL
                }

                $response = new RedirectResponse($this->router->generate('homepage'));
                $this->session->getFlashbag()->add('wbb-not-found', true);

                $event->setResponse($response);
            }
        }
    }

}
