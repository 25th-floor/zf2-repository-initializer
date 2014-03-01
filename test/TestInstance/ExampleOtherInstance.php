<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInstance;

use TwentyFifth\Zf2RepositoryInitializer\TestInterface\ExampleOtherRepositoryAware;

class ExampleOtherInstance implements ExampleOtherRepositoryAware
{
	private $example;

	public function setExampleOtherRepository($example)
	{
		$this->example = $example;
	}

	public function getExampleOtherRepository()
	{
		return $this->example;
	}
}