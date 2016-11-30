<?php
namespace Bricks\Business\Currency\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Business\Currency\ServiceManager\PluginManager\ParserPluginManager;

/**
 * @author Artur Sh. Mamedbekov
 */
class ParserPluginManagerFactory implements FactoryInterface{
  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    return new ParserPluginManager($container, $options?: []);
  }

  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function createService(ServiceLocatorInterface $container, $name = null, $requestedName = null){
    return $this($container, $requestedName?: ParserPluginManager::class, []);
  }
}
