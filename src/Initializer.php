<?php

namespace TwentyFifth\DoctrineZf2RepositoryInitializer;

use ReflectionClass;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Initializer for RepositoryAware services.
 */
class Initializer
	implements InitializerInterface
{
	const AWARENESS_INTERFACE = 'TwentyFifth\DoctrineZf2RepositoryInitializer\RepositoryAware';

	/**
	 * Initializes RepositoryAware services. All other services won't be touched.
	 *
	 * @param mixed $instance
	 * @param ServiceLocatorInterface $serviceLocator
	 * @throws Exception
	 * @return void
	 */
	public function initialize($instance, ServiceLocatorInterface $serviceLocator)
	{
		if (! $instance instanceof RepositoryAware) {
			return;
		}

		$serviceLocator = ($serviceLocator instanceof ControllerManager) ? $serviceLocator->getServiceLocator() : $serviceLocator;

		$refl = new \ReflectionObject($instance);
		foreach ($refl->getInterfaces() as $interface) {
			if (! $interface->isSubclassOf(self::AWARENESS_INTERFACE)) {
				continue;
			}

			$repositorySetter = $this->getRepositorySetter($interface);
			if (!method_exists($instance, $repositorySetter)) {
				throw new Exception('Instance of type '.get_class($instance).' does not implement method '.$repositorySetter.
					' which is required by the repository initializer');
			}

			$repositoryService = $this->getRepositoryService($interface);
			$instance->$repositorySetter($serviceLocator->get($repositoryService));
		}
	}

	/**
	 * Builds the repository setter method for an interface.
	 *
	 * @param ReflectionClass $interface
	 * @throws Exception
	 * @return string
	 */
	private function getRepositorySetter(ReflectionClass $interface)
	{
		if (1 !== preg_match('@([^\\\\]+)Aware@', $interface->getName(), $matches)) {
			throw new Exception('Awareness interface does not follow the required format <Repository>Aware');
		}

		$repositoryName = $matches[1];
		$repositorySetter = 'set'.$repositoryName;

		return $repositorySetter;
	}

	/**
	 * Extracts the repository service from a given interface.
	 *
	 * @param ReflectionClass $interface
	 * @return mixed
	 * @throws Exception
	 */
	private function getRepositoryService(ReflectionClass $interface)
	{
		if (1 !== preg_match('#@repositoryService\s+(.*)#', $interface->getDocComment(), $matches)) {
			throw new Exception('Awareness interface does not have a @repositoryService annotation');
		}

		$repositoryService = $matches[1];

		return $repositoryService;
	}
}
