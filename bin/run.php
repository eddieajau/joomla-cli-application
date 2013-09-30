<?php
/**
 * Analyses a Github repository based on tags.
 *
 * @copyright  Copyright (C) 2013 New Life in IT Pty Ltd. All rights reserved.
 * @license    LGPL-2.1 or later.
 */

// Max out error reporting for testing. Remove in production.
error_reporting(-1);
ini_set('display_errors', 1);

// Bootstrap the Joomla Framework.
require realpath(__DIR__ . '/../vendor/autoload.php');

try
{
	define('APPLICATION_CONFIG', realpath(__DIR__ . '/../etc/config.json'));

	$app = new Acme\Application;
	$app->execute();
}
catch (Exception $e)
{
	// An exception has been caught, just echo the message.
	fwrite(STDOUT, "Exception:\n " . $e->getMessage() . "\nTrace:\n");

	foreach ($e->getTrace() as $i => $trace)
	{
		fwrite(STDOUT, sprintf(
			"%2d. %s %s:%d\n",
			$i + 1,
			$trace['function'],
			str_ireplace(array(dirname(__DIR__)), '', $trace['file']),
			$trace['line']
		));
	}

	exit($e->getCode());
}
