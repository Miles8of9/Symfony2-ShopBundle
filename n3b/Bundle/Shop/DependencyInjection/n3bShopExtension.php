<?php

namespace n3b\Bundle\Shop\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class n3bShopExtension extends Extension
{
	public function load(array $configs, ContainerBuilder $container)
    {
        $config = array();
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }

        $this->parseConfigNode($container, $config, $this->getAlias());

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    protected function parseConfigNode($container, $node, $nodeName)
    {
        foreach ($node as $k => $n) {
            if (is_array($n))
                $this->parseConfigNode($container, $n, $nodeName . '.' . $k);
            else
                $container->setParameter($nodeName.'.'.$k, $n);
        }
    }

    public function getAlias() {
        return 'n3b_shop';
    }
}
