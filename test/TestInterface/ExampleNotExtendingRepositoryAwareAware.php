<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInterface;

use TwentyFifth\Zf2RepositoryInitializer\RepositoryAware;

/**
 * @repositoryService ExampleOtherRepository
 */
interface ExampleNotExtendingRepositoryAwareAware
{
	public function setExampleNotExtendingRepository($example);
	public function getExampleNotExtendingRepository();
}