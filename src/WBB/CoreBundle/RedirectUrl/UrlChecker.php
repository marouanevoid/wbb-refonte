<?php

namespace WBB\CoreBundle\RedirectUrl;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use WBB\CoreBundle\Entity\RedirectUrl;

class UrlChecker
{

    /**
     * @var string
     */
    private $webSiteUrl;

    public function __construct($webSiteUrl)
    {
        $this->webSiteUrl = $webSiteUrl;
    }

    public function exists(RedirectUrl $url)
    {
        $destinationC = $url->getDestinationCanonical();

        $client = new Client($this->webSiteUrl);
        $request = $client->get($destinationC);

        try {
            $statusCode = $request->send()->getStatusCode();
        } catch (ClientErrorResponseException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
        }

        if ($statusCode == 200) {
            return true;
        } else if ($statusCode == 404) {
            return false;
        }

        throw new \Exception("The page '$url' returned ");
    }

}
