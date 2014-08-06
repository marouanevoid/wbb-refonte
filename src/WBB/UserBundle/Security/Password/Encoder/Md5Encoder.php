<?php
namespace WBB\UserBundle\Security\Password\Encoder;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;

class Md5Encoder extends BasePasswordEncoder
{
    public function encodePassword($raw, $salt)
    {
        return md5($raw);
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $this->comparePasswords($encoded, $this->encodePassword($raw, $salt));
    }
}