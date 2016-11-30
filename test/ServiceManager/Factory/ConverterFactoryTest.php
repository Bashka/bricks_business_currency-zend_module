<?php
namespace Bricks\Business\Currency\UnitTest\ServiceManager\Factory;

use Zend\ServiceManager\ServiceManager;
use Bricks\Business\Currency\ConverterInterface;
use Bricks\Business\Currency\Currency;
use Bricks\Business\Currency\ServiceManager\Factory\ConverterFactory;
use Bricks\Business\Currency\ServiceManager\PluginManager\LoaderPluginManager;
use Bricks\Business\Currency\ServiceManager\PluginManager\ParserPluginManager;
use Bricks\Business\Currency\ServiceManager\Factory\LoaderPluginManagerFactory;
use Bricks\Business\Currency\ServiceManager\Factory\ParserPluginManagerFactory;

/**
 * @author Artur Sh. Mamedbekov
 */
class ConverterFactoryTest extends \PHPUnit_Framework_TestCase{
  public function testInvoke(){
    $factory = new ConverterFactory;
    $container = new ServiceManager([
      'services' => [
        'Configuration' => [
          'business_currency' => [
            'loader' => [
              'name' => 'cbr',
              'options' => [
                'uri' => __DIR__ . '/data/cbr.xml',
              ],
            ],
            'parser' => 'cbr',
          ],
        ],
      ],
      'factories' => [
        LoaderPluginManager::class => LoaderPluginManagerFactory::class,
        ParserPluginManager::class => ParserPluginManagerFactory::class,
      ],
    ]);

    $converter = $factory($container, ConverterInterface::class);

    $this->assertInstanceof(ConverterInterface::class, $converter);
    $this->assertEquals(2, $converter->getRate(new Currency('USD'), new Currency('RUR')));
  }
}
