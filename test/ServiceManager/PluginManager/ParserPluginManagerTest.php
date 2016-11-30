<?php
namespace Bricks\Business\Currency\UnitTest\ServiceManager\PluginManager;

use Zend\ServiceManager\ServiceManager;
use Bricks\Business\Currency\Parser\ParserInterface;
use Bricks\Business\Currency\ServiceManager\PluginManager\ParserPluginManager;

/**
 * @author Artur Sh. Mamedbekov
 */
class ParserPluginManagerTest extends \PHPUnit_Framework_TestCase{
  public function testGet(){
    $pluginManager = new ParserPluginManager(new ServiceManager);

    $this->assertInstanceof(ParserInterface::class, $pluginManager->get('cbr'));
  }
}
