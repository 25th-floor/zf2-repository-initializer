<?php

function includeIfExists($file)
{
	if (file_exists($file)) {
		return include $file;
	}

	return null;
}

if ((!$loader = includeIfExists(__DIR__.'/../vendor/autoload.php')) && (!$loader = includeIfExists(__DIR__.'/../../../autoload.php'))) {
	die('You must set up the project dependencies, run the following commands:'.PHP_EOL.
		'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
		'php composer.phar install'.PHP_EOL);
}

/** @var \Composer\Autoload\ClassLoader $loader */
$loader->addPsr4('TwentyFifth\Zf2RepositoryInitializer\TestRepository\\', dirname(__FILE__) . '/TestRepository/');
$loader->addPsr4('TwentyFifth\Zf2RepositoryInitializer\TestInterface\\', dirname(__FILE__) . '/TestInterface/');
$loader->addPsr4('TwentyFifth\Zf2RepositoryInitializer\TestInstance\\', dirname(__FILE__) . '/TestInstance/');
