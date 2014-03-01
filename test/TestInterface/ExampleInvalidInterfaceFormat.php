<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInterface;

use TwentyFifth\Zf2RepositoryInitializer\RepositoryAware;

/**
 * @repositoryService ExampleRepository
 */
interface ExampleInvalidInterfaceFormat extends RepositoryAware
{
	public function setExampleRepository($example);
	public function getExampleRepository();
}
