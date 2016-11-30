<?php
namespace Bricks\Business\Currency\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Business\Currency\Loader\ProxyCacheLoader;

/**
 * @author Artur Sh. Mamedbekov
 */
class ProxyCacheLoaderFactory implements FactoryInterface{
  /**
   * zend-servicemanager v2 support for invocation options.
   * 
   * @var array
   */
  private $creationOptions;

  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    $options = is_null($options)? [] : $options;
    $cache = $options['application_container']->get($options['cache']);
    $loader = $container->get($options['loader']);
    $key = isset($options['key'])? $container->get($options['key']) : null;

    return new ProxyCacheLoader($cache, $loader, $key);
  }
  
  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function createService(ServiceLocatorInterface $container, $name = null, $requestedName = null){
    return $this($container, $requestedName?: ConverterInterface::class, $this->creationOptions);
  }

  /**
   * @param array $creationOptions
   */
  public function setCreationOptions($creationOptions){
    $this->creationOptions = $creationOptions;
  }
}
