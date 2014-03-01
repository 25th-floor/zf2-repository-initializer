<?php

namespace TwentyFifth\Zf2RepositoryInitializer\TestInstance;

use TwentyFifth\Zf2RepositoryInitializer\TestInterface\ExampleInvalidInterfaceFormat;

class ExampleInvalidInterfaceInstance implements ExampleInvalidInterfaceFormat
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