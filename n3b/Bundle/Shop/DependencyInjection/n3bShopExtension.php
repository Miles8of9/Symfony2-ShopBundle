<?php

namespace n3b\Bundle\Shop\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class n3bShopExtension extends Extension
{
	public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        new \n3b\Bundle\Util\Service\Config\ConfigParser($configs, $container, $this->getAlias());
    }

    public function getAlias() {
        return 'n3b_shop';
    }
}
