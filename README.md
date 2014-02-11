# A ZF2 initializer for Repositories

## Installation

Add the following as requirement to you composer.json:

    25th/zf2-repository-initializer": "dev-master"

## Usage

Add the class as initializer in the appropriate module.config.php.

    'initializers' => [
            'TwentyFifth\Zf2RepositoryInitializer\Initializer',
    ],

The injection targets must implement a sub-interface of <i>TwentyFifth\ZF2RepositoryInitializer\RepositoryAware</i> and
this sub-interface must specify a service key that will be used to look for the injection object. The name of the interface
must end with <i>Aware</i> like <i>FooRepositoryAware</i> and the Initializer also requires the sub-interface or the injection
target to implement a method <i>set&lt;RepositoryName&gt;</i> where RepositoryName is the Prefix to Aware. So all subclasses
of <i>FooRepositoryAware</i> must have a method <i>setFooRepository</i>.

Further the interface must provide an annotation <i>@repositoryService</i> which specifies a service key. The service
manager will be called with this key in order to load the service.

## TODO

- Reflection Caching
- Tests
- Correct composer dependencies (ZF2, PHP, ... ?)
