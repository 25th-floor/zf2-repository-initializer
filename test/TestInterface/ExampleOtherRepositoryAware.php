<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInterface;

use TwentyFifth\Zf2RepositoryInitializer\RepositoryAware;

/**
 * @repositoryService ExampleOtherRepository
 */
interface ExampleOtherRepositoryAware extends RepositoryAware
{
	public function setExampleOtherRepository($example);
	public function getExampleOtherRepository();
}