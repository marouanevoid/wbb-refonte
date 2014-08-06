<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new FOS\UserBundle\FOSUserBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            // Add your dependencies
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),

            // DataFixtures
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Hautelook\AliceBundle\HautelookAliceBundle(),

            //MediaBundle
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),

            //Foursquare
            new Jcroll\FoursquareApiBundle\JcrollFoursquareApiBundle(),

            //Mobile Detecte
            new SunCat\MobileDetectBundle\MobileDetectBundle(),

            // sonata formatter
            new Sonata\MarkItUpBundle\SonataMarkItUpBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            
            // sonata datepiker
            new Stnw\DatePickerBundle\StnwDatePickerBundle(),

            //Serializer Bundle
            new JMS\SerializerBundle\JMSSerializerBundle($this),

            //CSV Import Bundle
            new Ddeboer\DataImportBundle\DdeboerDataImportBundle(),

//            new Cybernox\AmazonWebServicesBundle\CybernoxAmazonWebServicesBundle(),

            //Bitly Bundle
            new Hpatoio\BitlyBundle\HpatoioBitlyBundle(),

            //Memcached
            new Aequasi\Bundle\CacheBundle\AequasiCacheBundle(),

            // WBB Bundles
            new WBB\UserBundle\WBBUserBundle(),
            new WBB\CoreBundle\WBBCoreBundle(),
            new WBB\BarBundle\WBBBarBundle(),
            new WBB\CloudSearchBundle\WBBCloudSearchBundle(),
            
            new FOS\FacebookBundle\FOSFacebookBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
