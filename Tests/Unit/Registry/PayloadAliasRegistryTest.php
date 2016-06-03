<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2015 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ResourceRestBundle\Tests\Registry;

use Symfony\Cmf\Bundle\ResourceRestBundle\Registry\PayloadAliasRegistry;

class PayloadAliasRegistryTest extends \PHPUnit_Framework_TestCase
{
    private $repositoryRegistry;
    private $resource;
    private $repository;

    public function setUp()
    {
        $this->repositoryRegistry = $this->prophesize('Symfony\Cmf\Component\Resource\RepositoryRegistryInterface');
        $this->resource = $this->prophesize('Symfony\Cmf\Component\Resource\Repository\Resource\CmfResource');
        $this->repository = $this->prophesize('Puli\Repository\Api\ResourceRepository');
    }

    public function provideRegistry()
    {
        return array(
            array(
                array(
                    'article' => array(
                        'repository' => 'doctrine_phpcr_odm',
                        'type' => 'Article',
                    ),
                ),
                array(
                    'type' => null,
                    'repository' => 'doctrine_phpcr_odm',
                ),
                null,
            ),
        );
    }

    /**
     * @dataProvider provideRegistry
     */
    public function testRegistry($aliases, $resource, $expectedAlias)
    {
        $registry = $this->createRegistry($aliases);

        $this->repositoryRegistry->getRepositoryType(
            $this->repository
        )->willReturn($resource['repository']);
        $this->resource->getPayloadType()->willReturn($resource['type']);
        $this->resource->getRepository()->willReturn($this->repository);

        $alias = $registry->getPayloadAlias($this->resource->reveal());
        $this->assertEquals($expectedAlias, $alias);
    }

    private function createRegistry($aliases)
    {
        return new PayloadAliasRegistry($this->repositoryRegistry->reveal(), $aliases);
    }
}
