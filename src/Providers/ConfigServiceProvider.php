<?php
/**
 * Configuration service provider.
 *
 * @copyright  Copyright (C) 2013 New Life in IT Pty Ltd. All rights reserved.
 * @license    LGPL-2.1 or later.
 */

namespace Providers;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Registry\Registry;

/**
 * Registers the Configuration service provider.
 *
 * Note that the application requires the `APPLICATION_CONFIG` constant to be set with the path to the JSON configuration file.
 *
 * @since  1.2
 */
class ConfigServiceProvider implements ServiceProviderInterface
{
	/**
	 * @var    string
	 * @since  1.0
	 */
	private $path;

	/**
	 * Class constructor.
	 *
	 * @param   string  $path  The full path and file name for the configuration file.
	 *
	 * @since   1.0
	 */
	public function __construct($path)
	{
		$this->path = $path;
	}

	/**
	 * Gets a configuration object.
	 *
	 * @param   Container  $c  A DI container.
	 *
	 * @return  Registry
	 *
	 * @since   1.0
	 * @throws  \LogicException if the configuration file does not exist.
	 * @throws  \UnexpectedValueException if the configuration file could not be parsed.
	 */
	public function getConfig(Container $c)
	{
		if (!file_exists($this->path))
		{
			throw new \LogicException('Configuration file does not exist.', 500);
		}

		$json = json_decode(file_get_contents($this->path));

		if (null === $json)
		{
			throw new \UnexpectedValueException('Configuration file could not be parsed.', 500);
		}

		return new Registry($json);
	}

	/**
	 * Registers the service provider within a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function register(Container $container)
	{
		// Workaround for PHP 5.3 compatibility.
		$that = $this;
		$container->share(
			'config',
			function ($c) use ($that)
			{
				return $that->getConfig($c);
			}
			, true
		);
	}
}
