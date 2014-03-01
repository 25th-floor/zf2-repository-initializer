<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInterface;

use TwentyFifth\Zf2RepositoryInitializer\RepositoryAware;

/**
 * @repositoryService ExampleRepository
 */
interface ExampleRepositoryAware extends RepositoryAware
{
	public function setExampleRepository($example);
	public function getExampleRepository();
}
