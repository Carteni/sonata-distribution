<?php

namespace AppAdminBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class AdminExtension
 *
 * @package AdminBundle\DependencyInjection
 */
class AppAdminExtension extends ConfigurableExtension implements PrependExtensionInterface
{

	/**
	 * Allow an extension to prepend the extension configurations.
	 *
	 * @param ContainerBuilder $container
	 */
	public function prepend(ContainerBuilder $container)
	{
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('config.yml');
	}

	/**
	 * Configures the passed container according to the merged configuration.
	 *
	 * @param array $mergedConfig
	 * @param ContainerBuilder $container
	 */
	protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
	{
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('admins.yml');
		$loader->load('services.yml');
	}
}