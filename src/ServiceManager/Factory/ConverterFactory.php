<?php
namespace Bricks\Business\Currency\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Business\Currency\ServiceManager\PluginManager\LoaderPluginManager;
use Bricks\Business\Currency\ServiceManager\PluginManager\ParserPluginManager;
use Bricks\Business\Currency\ConverterInterface;
use Bricks\Business\Currency\Converter;

/**
 * @author Artur Sh. Mamedbekov
 */
class ConverterFactory implements FactoryInterface{
  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    $options = $container->get('Configuration');
    $options = $options['business_currency'];

    $loader = $options['loader'];
    $loaderOptions = [];
    if(is_array($loader)){
      if(isset($loader['options'])){
        $loaderOptions = $loader['options'];
      }
      $loader = $loader['name'];
    }
    $loader = $container->get(LoaderPluginManager::class)->get($loader, $loaderOptions + ['application_container' => $container]);
    $data = $loader->load();

    $parser = $options['parser'];
    $parserOptions = [];
    if(is_array($parser)){
      if(isset($parser['options'])){
        $parserOptions = $parser['options'];
      }
      $parser = $parser['name'];
    }
    $parser = $container->get(ParserPluginManager::class)->get($parser, $parserOptions + ['application_container' => $container]);

    return $parser->parse($data);
  }

  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function createService(ServiceLocatorInterface $container, $name = null, $requestedName = null){
    return $this($container, $requestedName?: ConverterInterface::class, []);
  }
}
