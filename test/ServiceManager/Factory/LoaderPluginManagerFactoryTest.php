<?php
namespace Bricks\Business\Currency\UnitTest\ServiceManager\Factory;

use Zend\ServiceManager\ServiceManager;
use Bricks\Business\Currency\ServiceManager\PluginManager\LoaderPluginManager;
use Bricks\Business\Currency\ServiceManager\Factory\LoaderPluginManagerFactory;

/**
 * @author Artur Sh. Mamedbekov
 */
class LoaderPluginManagerFactoryTest extends \PHPUnit_Framework_TestCase{
  public function testInvoke(){
    $factory = new LoaderPluginManagerFactory(new ServiceManager);

    $this->assertInstanceof(LoaderPluginManager::class, $factory(new ServiceManager, LoaderPluginManager::class));
  }
}
