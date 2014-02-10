<?php

namespace TwentyFifth\DoctrineZf2RepositoryInitializer;

class Exception extends \Exception
{
	public static function repositorySetterMissingInInstance(RepositoryAware $instance, $repositorySetter)
	{
		$message = sprintf(
			'Instance of type %s does not implement method %s which is required by the repository initializer',
			get_class($instance),
			$repositorySetter
		);
		return new self($message);
	}

	public static function invalidAwarenessInterfaceFormat()
	{
		return new self('Awareness interface does not follow the required format <Repository>Aware');
	}

	public static function RepositoryServiceDefinitionMissing($interfaceName)
	{
		return new self('Awareness interface %s does not have a @repositoryService annotation', $interfaceName);
	}
}