<?php
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Beyerz\CheckBookIOBundle\CheckBookIOBundle(),
        );
    }
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
    /**
     * @return string
     */
    public function getCacheDir()
    {
        return sys_get_temp_dir().'/CheckBookIOBundle/cache';
    }
    /**
     * @return string
     */
    public function getLogDir()
    {
        return sys_get_temp_dir().'/CheckBookIOBundle/logs';
    }
}