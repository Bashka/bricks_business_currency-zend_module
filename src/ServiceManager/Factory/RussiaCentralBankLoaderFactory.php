<?php
namespace Bricks\Business\Currency\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Business\Currency\Loader\RussiaCentralBankLoader;

/**
 * @author Artur Sh. Mamedbekov
 */
class RussiaCentralBankLoaderFactory implements FactoryInterface{
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

    if(isset($options['uri'])){
      return new RussiaCentralBankLoader($options['uri']);
    }
    else{
      return new RussiaCentralBankLoader;
    }
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
