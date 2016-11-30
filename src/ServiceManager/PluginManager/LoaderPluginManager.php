<?php
namespace Bricks\Business\Currency\ServiceManager\PluginManager;

use RuntimeException;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Bricks\Business\Currency\Loader\LoaderInterface;
use Bricks\Business\Currency\Loader\RussiaCentralBankLoader;
use Bricks\Business\Currency\ServiceManager\Factory\RussiaCentralBankLoaderFactory;
use Bricks\Business\Currency\Loader\ProxyCacheLoader;
use Bricks\Business\Currency\ServiceManager\Factory\ProxyCacheLoaderFactory;

/**
 * @author Artur Sh. Mamedbekov
 */
class LoaderPluginManager extends AbstractPluginManager{
  /**
   * {@inheritdoc}
   */
  protected $aliases = [
    'cbr'         => RussiaCentralBankLoader::class,
    'proxy_cache' => ProxyCacheLoader::class,
  ];

  /**
   * {@inheritdoc}
   */
  protected $factories = [
    RussiaCentralBankLoader::class => RussiaCentralBankLoaderFactory::class,
    ProxyCacheLoader::class        => ProxyCacheLoaderFactory::class,

    // v2 normalized FQCNs
    'bricksbusinesscurrencyloaderrussiacentralbankloader' => RussiaCentralBankLoaderFactory::class,
    'bricksbusinesscurrencyloaderproxycacheloader' => ProxyCacheLoaderFactory::class,
  ];

  /**
   * {@inheritdoc}
   */
  protected $sharedByDefault = false;

  /**
   * For v3.
   *
   * {@inheritdoc}
   */
  protected $instanceOf = LoaderInterface::class;

  /**
   * For v3.
   *
   * {@inheritdoc}
   */
  public function validate($instance){
    if(!$instance instanceof $this->instanceOf){
      throw new InvalidServiceException(sprintf(
        '%s can only create instances of %s; %s is invalid',
        get_class($this),
        $this->instanceOf,
        (is_object($instance) ? get_class($instance) : gettype($instance))
      ));
    }
  }

  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function validatePlugin($plugin){
    try{
      $this->validate($plugin);
    }
    catch(InvalidServiceException $e){
      throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
    }
  }
}
