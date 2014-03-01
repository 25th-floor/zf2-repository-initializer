<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInstance;

use TwentyFifth\Zf2RepositoryInitializer\TestInterface\ExampleNotExtendingRepositoryAwareAware;
use TwentyFifth\Zf2RepositoryInitializer\TestInterface\ExampleOtherRepositoryAware;
use TwentyFifth\Zf2RepositoryInitializer\TestInterface\ExampleRepositoryAware;

class ExampleThreeRepositoriesInstance implements ExampleRepositoryAware,
			                                      ExampleOtherRepositoryAware,
			                                      ExampleNotExtendingRepositoryAwareAware
{
	private $example;
	private $example2;
	private $example3;

	public function setExampleRepository($example)
	{
		$this->example = $example;
	}

	public function getExampleRepository()
	{
		return $this->example;
	}

	public function setExampleOtherRepository($example2)
	{
		$this->example2 = $example2;
	}

	public function getExampleOtherRepository()
	{
		return $this->example2;
	}

	public function setExampleNotExtendingRepository($example)
	{
		$this->example3;
	}

	public function getExampleNotExtendingRepository()
	{
		return $this->example3;
	}
}