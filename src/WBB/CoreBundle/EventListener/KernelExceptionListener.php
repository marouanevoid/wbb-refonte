<?php

namespace WBB\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use WBB\CoreBundle\RedirectUrl\UrlMatcher;
use WBB\BarBundle\Controller\BarController;

class KernelExceptionListener
{

    private $router;
    private $session;
    private $urlMatcher;
    private $barController;

    public function __construct(RouterInterface $router, SessionInterface $session, UrlMatcher $urlMatcher, BarController $barController)
    {
        $this->router = $router;
        $this->session = $session;
        $this->urlMatcher = $urlMatcher;
        $this->barController = $barController;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof HttpExceptionInterface) {
            if ($exception->getStatusCode() == 404) {
                $request = $event->getRequest();
                $url = $request->getPathInfo();
                $matched = $this->urlMatcher->match($url);

                if ($matched) {
                    $url = $request->getBaseUrl() . $matched->getDestinationCanonical();
                    $statusCode = $matched->getRedirect();

                    $response = new RedirectResponse($url, $statusCode);
                } else {
                    $this->session->set('wbb-not-found', true);
                    $response = $this->barController->homeAction($request);
                    $this->session->remove('wbb-not-found');
                }

                $event->setResponse($response);
            }
        }
    }

}
