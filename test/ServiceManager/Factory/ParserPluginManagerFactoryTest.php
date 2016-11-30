<?php
namespace Bricks\Business\Currency\UnitTest\ServiceManager\Factory;

use Zend\ServiceManager\ServiceManager;
use Bricks\Business\Currency\ServiceManager\PluginManager\ParserPluginManager;
use Bricks\Business\Currency\ServiceManager\Factory\ParserPluginManagerFactory;

/**
 * @author Artur Sh. Mamedbekov
 */
class ParserPluginManagerFactoryTest extends \PHPUnit_Framework_TestCase{
  public function testInvoke(){
    $factory = new ParserPluginManagerFactory(new ServiceManager);

    $this->assertInstanceof(ParserPluginManager::class, $factory(new ServiceManager, ParserPluginManager::class));
  }
}
