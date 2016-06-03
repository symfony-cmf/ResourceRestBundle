<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2015 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Cmf\Bundle\ResourceRestBundle\Enhancer;

use Puli\Repository\Api\Resource\Resource;

/**
 * Enhancer classes enhance the REST response for resources.
 *
 * @author Daniel Leech <daniel@dantleech.com>
 */
interface EnhancerInterface
{
    /**
     * Enhance the given serialization context.
     *
     * For example:
     *
     *     $context->addData('foobar', 'Some value');
     *
     * @param []       $data        Context Serialization context
     * @param Resource $resource    The resource being serialized
     */
    public function enhance(array $data, Resource $resource);
}
