<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-zendrouter for the canonical source repository
 * @copyright Copyright (c) 2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-zendrouter/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace ZendTest\Expressive\Router\ZendRouter;

use PHPUnit\Framework\TestCase;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Router\ZendRouter;
use Zend\Expressive\Router\ZendRouter\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    /**
     * @var ConfigProvider
     */
    private $provider;

    protected function setUp() : void
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvocationReturnsArray() : array
    {
        $config = ($this->provider)();
        self::assertInternalType('array', $config);

        return $config;
    }

    /**
     * @depends testInvocationReturnsArray
     */
    public function testReturnedArrayContainsDependencies(array $config) : void
    {
        self::assertArrayHasKey('dependencies', $config);
        self::assertInternalType('array', $config['dependencies']);

        self::assertArrayHasKey('aliases', $config['dependencies']);
        self::assertInternalType('array', $config['dependencies']['aliases']);
        self::assertArrayHasKey(RouterInterface::class, $config['dependencies']['aliases']);

        self::assertArrayHasKey('invokables', $config['dependencies']);
        self::assertInternalType('array', $config['dependencies']['invokables']);
        self::assertArrayHasKey(ZendRouter::class, $config['dependencies']['invokables']);
    }
}
