<?php

namespace TwentyFifth\DoctrineZf2RepositoryInitializer;

use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Initializer
	implements InitializerInterface
{
	public function initialize($instance, ServiceLocatorInterface $serviceLocator)
	{
		if ($serviceLocator instanceof ControllerManager) {
			$serviceLocator = $serviceLocator->getServiceLocator();
		}

		if ($instance instanceof RepositoryAware) {
			$refl = new \ReflectionObject($instance);
			foreach ($refl->getInterfaces() as $interface) {
				if ($interface->isSubclassOf('TwentyFifth\DoctrineZf2RepositoryInitializer\RepositoryAware')) {
					if (1 !== preg_match('@([^\\\\]+)Aware@', $interface->getName(), $matches)) {
						continue;
					}

					$repositoryName = $matches[1];
					$repositorySetter = 'set'.$repositoryName;
					if (!method_exists($instance, $repositorySetter)) {
						//....
						continue;
					}

					if (1 !== preg_match('#@repositoryService (.*)#', $interface->getDocComment(), $matches)) {
						// ...
						continue;
					}
					$repositoryService = $matches[1];

					$instance->$repositorySetter($serviceLocator->get($repositoryService));
				}
			}
		}
	}
}
