<?php
namespace Bricks\Business\Currency;

use Bricks\Business\Currency\ServiceManager\PluginManager\LoaderPluginManager;
use Bricks\Business\Currency\ServiceManager\PluginManager\ParserPluginManager;
use Bricks\Business\Currency\ConverterInterface;
use Bricks\Business\Currency\ServiceManager\Factory\LoaderPluginManagerFactory;
use Bricks\Business\Currency\ServiceManager\Factory\ParserPluginManagerFactory;
use Bricks\Business\Currency\ServiceManager\Factory\ConverterFactory;

return [
  // Configuration module.
  'business_currency' => [
    // Loader class.
    'loader' => 'cbr',
    // Parser class.
    'parser' => 'cbr',
  ],
  'service_manager' => [
    'factories' => [
      LoaderPluginManager::class => LoaderPluginManagerFactory::class,
      ParserPluginManager::class => ParserPluginManagerFactory::class,
      ConverterInterface::class => ConverterFactory::class,
    ],
  ],
];
