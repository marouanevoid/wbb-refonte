<?php

namespace WBB\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WBBUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
