<?php
/**
 * The Acme application.
 *
 * @copyright  Copyright (C) 2013 New Life in IT Pty Ltd. All rights reserved.
 * @license    LGPL-2.1 or later.
 */

namespace Acme;

use Joomla\Application\AbstractCliApplication;
use Joomla\Application\Cli\Output\Processor\ColorProcessor;
use Joomla\DI\Container;

/**
 * The Acme application class.
 *
 * @since  1.0
 */
class Application extends AbstractCliApplication
{
	/**
	 * The application version.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const VERSION = '1.0';

	/**
	 * The application's DI container.
	 *
	 * @var    Di\Container
	 * @since  1.1
	 */
	private $container;

	/**
	 * Execute the application.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function doExecute()
	{
		$this->getOutput()->setProcessor(new ColorProcessor);

		// Check if help is needed.
		if ($this->input->get('h') || $this->input->get('help'))
		{
			$this->help();

			return;
		}

		$this->container->get('logger')->debug('It works!');
	}

	/**
	 * Custom initialisation method.
	 *
	 * Called at the end of the AbstractApplication::__construct method. This is for developers to inject initialisation code for their application classes.
	 *
	 * @return  void
	 *
	 * @codeCoverageIgnore
	 * @since   1.0
	 */
	protected function initialise()
	{
		// New DI stuff!
		$container = new Container;
		$input = $this->input;

		$container->share('input', function (Container $c) use ($input) {
			return $input;
		}, true);

		$container->registerServiceProvider(new \Providers\ConfigServiceProvider);
		$container->registerServiceProvider(new \Providers\LoggerServiceProvider);

		$this->container = $container;

		// Maintain configuration API compatibility with \Joomla\Application\AbstractApplication.
		$this->config = $container->get('config');
	}

	/**
	 * Display the help text.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	private function help()
	{
		$this->out('Acme ' . self::VERSION);
		$this->out();
		$this->out('Usage:     php -f run.php -- [switches]');
		$this->out();
		$this->out('Switches:  -h | --help    Prints this usage information.');
		$this->out();
		$this->out('Examples:  php -f run.php -h');
		$this->out();
	}
}
