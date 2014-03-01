<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInstance;

use TwentyFifth\Zf2RepositoryInitializer\TestInterface\ExampleRepositoryAware;

class ExampleInstance implements ExampleRepositoryAware
{
	private $example;

	public function setExampleRepository($example)
	{
		$this->example = $example;
	}

	public function getExampleRepository()
	{
		return $this->example;
	}
}