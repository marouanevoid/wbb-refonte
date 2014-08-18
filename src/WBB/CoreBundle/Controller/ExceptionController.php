<?php
namespace WBB\CoreBundle\Controller;

use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseExceptionController;

class ExceptionController extends BaseExceptionController
{
    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $_format = 'html')
    {
        var_dump('die');die;

        if ($this->container->get('request')->get('_route') == "abcRoute") {
            $appTemplate = "backend";
        } else {
            $appTemplate = "frontend";
        }

        $template = $this->container->get('kernel')->isDebug() ? 'exception' : 'error';
        $code = $exception->getStatusCode();

        return $this->container->get('templating')->renderResponse(
            'AcmeDemoBundle:Exception:' . $appTemplate . '_' . $template . '.html.twig',
            array(
                'status_code'    => $code,
                'status_text'    => Response::$statusTexts[$code],
                'exception'      => $exception,
                'logger'         => null,
                'currentContent' => '',
            )
        );
    }
}