<?php
/**
 * Logger service provider.
 *
 * @copyright  Copyright (C) 2013 New Life in IT Pty Ltd. All rights reserved.
 * @license    LGPL-2.1 or later.
 */

namespace Providers;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Registers the Logger service provider.
 *
 * @since  1.2
 */
class LoggerServiceProvider implements ServiceProviderInterface
{
	/**
	 * Registers the service provider within a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.2
	 */
	public function register(Container $container)
	{
		$container->share('logger', function(Container $c) {

			$config = $c->get('config');
			$logger = new Logger($config->get('logger.channel'));

			$logger->pushHandler(new StreamHandler('php://stdout'));

			return $logger;
		}, true);
	}
}
