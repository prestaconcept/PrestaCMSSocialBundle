<?php
/**
 * This file is part of the PrestaCMSSocialBundle
 *
 * (c) PrestaConcept <www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class PrestaCMSSocialExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        if (isset($config['twitter'])) {
            $loader->load('twitter.xml');
            $container->setParameter(
                'presta_cms_social.twitter.url',
                $config['twitter']['url']
            );
            $container->setParameter(
                'presta_cms_social.twitter.consumer_key',
                $config['twitter']['consumer_key']
            );
            $container->setParameter(
                'presta_cms_social.twitter.consumer_secret',
                $config['twitter']['consumer_secret']
            );
            $container->setParameter(
                'presta_cms_social.twitter.token',
                $config['twitter']['token']
            );
            $container->setParameter(
                'presta_cms_social.twitter.token_secret',
                $config['twitter']['token_secret']
            );
        }
    }
}
