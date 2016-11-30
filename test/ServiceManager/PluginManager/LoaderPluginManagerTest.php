<?php
namespace Bricks\Business\Currency\UnitTest\ServiceManager\PluginManager;

use Zend\ServiceManager\ServiceManager;
use Bricks\Business\Currency\Loader\LoaderInterface;
use Bricks\Business\Currency\ServiceManager\PluginManager\LoaderPluginManager;

/**
 * @author Artur Sh. Mamedbekov
 */
class LoaderPluginManagerTest extends \PHPUnit_Framework_TestCase{
  public function testGet(){
    $pluginManager = new LoaderPluginManager(new ServiceManager);

    $this->assertInstanceof(LoaderInterface::class, $pluginManager->get('cbr'));
  }
}
