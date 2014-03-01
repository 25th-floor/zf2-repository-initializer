<?php

namespace TwentyFifth\Zf2RepositoryInitializer;

use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleInvalidInterfaceInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleMissingSetterInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleOtherInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleThreeRepositoriesInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleTwoRepositoriesInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestInstance\ExampleWithMissingServiceInstance;
use TwentyFifth\Zf2RepositoryInitializer\TestRepository\ExampleOtherRepository;
use TwentyFifth\Zf2RepositoryInitializer\TestRepository\ExampleRepository;

class InitializerTest extends \PHPUnit_Framework_TestCase
{
	/** @var  Initializer */
	private $initializer;

	public function setUp()
	{
		$this->initializer = new Initializer();
	}

	/**
	 * @dataProvider provideTestData
	 */
	public function testInitialize($example, $expected, $serviceLocator, $getMethod)
	{
		$this->initializer->initialize($example, $serviceLocator);
		$this->assertSame($expected, $example->{$getMethod}());
	}

	/**
	 * @expectedException \TwentyFifth\Zf2RepositoryInitializer\Exception
	 */
	public function testRepositorySetterMissingInInstanceException()
	{
		$this->initializer->initialize(new ExampleMissingSetterInstance(), $this->getServiceLocatorMock());
	}

	/**
	 * @expectedException \TwentyFifth\Zf2RepositoryInitializer\Exception
	 */
	public function testInvalidAwarenessInterfaceFormat()
	{
		$this->initializer->initialize(new ExampleInvalidInterfaceInstance(), $this->getServiceLocatorMock());

	}

	/**
	 * @expectedException \TwentyFifth\Zf2RepositoryInitializer\Exception
	 */
	public function testRepositoryServiceDefinitionMissing()
	{
		$this->initializer->initialize(new ExampleWithMissingServiceInstance(), $this->getServiceLocatorMock());
	}

	/**
	 *
	 * prepares the test data :
	 * array( example instance  |  expectation  |  ServiceLocator Mock  |  method to be called on instance )
	 *
	 * @return array
	 *
	 */
	public function provideTestData()
	{
		$example = new ExampleInstance();
		$example2 = new ExampleOtherInstance();
		// test with 2 repositoryAware implementations (both instance of RepositoryAware)
		$example3 = new ExampleTwoRepositoriesInstance();
		// test with 3 repositoryAware implementations (2 are instance of RepositoryAware)
		$example4 = new ExampleThreeRepositoriesInstance();

		$expected1 = new ExampleRepository();
		$expected2 = new ExampleOtherRepository();

		$serviceLocator1 = $this->getServiceLocatorMock(['ExampleRepository' => $expected1]);
		$serviceLocator2 = $this->getServiceLocatorMock(['ExampleOtherRepository' => $expected2]);
		$serviceLocator3a = $this->getServiceLocatorMock(['ExampleRepository' => $expected1, 'ExampleOtherRepository' => $expected2]);
		$serviceLocator3b = $this->getServiceLocatorMock(['ExampleRepository' => $expected1, 'ExampleOtherRepository' => $expected2]);
		$serviceLocator4a = $this->getServiceLocatorMock(['ExampleRepository' => $expected1, 'ExampleOtherRepository' => $expected2]);;
		$serviceLocator4b = $this->getServiceLocatorMock(['ExampleRepository' => $expected1, 'ExampleOtherRepository' => $expected2]);;
		$serviceLocator4c = $this->getServiceLocatorMock(['ExampleRepository' => $expected1, 'ExampleOtherRepository' => $expected2]);;

		return [
			[$example,  $expected1, $serviceLocator1, 'getExampleRepository'],
			[$example2, $expected2, $serviceLocator2, 'getExampleOtherRepository'],
			[$example3, $expected1, $serviceLocator3a, 'getExampleRepository'],
			[$example3, $expected2, $serviceLocator3b, 'getExampleOtherRepository'],
			[$example4, $expected1, $serviceLocator4a, 'getExampleRepository'],
			[$example4, $expected2, $serviceLocator4b, 'getExampleOtherRepository'],
			[$example4, null,       $serviceLocator4c, 'getExampleNotExtendingRepository'],
		];
	}

	/**
	 * @param array $returnValue
	 *
	 * @return mixed ServiceLocatorMock
	 */
	protected function getServiceLocatorMock(array $returnValue = array())
	{
		$i = 0;

		$serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');

		foreach ($returnValue as $with => $expected) {
			$serviceLocator->expects($this->at($i))
				->method('get')
				->with($with)
				->will($this->returnValue($expected));

			$i++;
		}

		return $serviceLocator;
	}

}
