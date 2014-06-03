<?php

namespace WBB\CoreBundle\Twig\Extension;

use SunCat\MobileDetectBundle\Twig\Extension\MobileDetectExtension as BaseMobileDetectExtension;
use SunCat\MobileDetectBundle\DeviceDetector\MobileDetector;
use SunCat\MobileDetectBundle\Helper\DeviceView;

class MobileDetectExtension extends BaseMobileDetectExtension
{
    protected $mobileDetector;
    protected $deviceView;

    /**
     * Constructor
     *
     * @param \SunCat\MobileDetectBundle\DeviceDetector\MobileDetector $mobileDetector
     * @param \SunCat\MobileDetectBundle\Helper\DeviceView $deviceView
     * @internal param \WBB\CoreBundle\Twig\Extension\Container $serviceContainer
     */
    public function __construct(MobileDetector $mobileDetector, DeviceView $deviceView)
    {
        parent::__construct($mobileDetector, $deviceView);

        $this->mobileDetector = $mobileDetector;
        $this->deviceView = $deviceView;
    }

    /**
     * Get extension twig function
     * @return array
     */
    public function getFunctions()
    {
        return array_merge(
            array('mobile_version' => new \Twig_Function_Method($this, 'mobileVersion')),
            parent::getFunctions()
        );
    }

    /**
     * Is mobile
     * @param $name
     * @return boolean
     */
    public function mobileVersion($name)
    {
        return $this->mobileDetector->version($name);
    }
}