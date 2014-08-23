<?php

namespace WBB\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class KernelExceptionListener
{

    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof HttpExceptionInterface) {
            if ($exception->getStatusCode() == 404) {
                $response = new RedirectResponse($this->router->generate('homepage'));

                $event->setResponse($response);
            }
        }
    }

}
