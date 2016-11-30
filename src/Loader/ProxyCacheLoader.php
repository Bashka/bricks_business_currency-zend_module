<?php
namespace Bricks\Business\Currency\Loader;

use Zend\Cache\Storage\StorageInterface;

/**
 * @author Artur Sh. Mamedbekov
 */
class ProxyCacheLoader implements LoaderInterface{
  const DEFAULT_KEY = 'converter_currency_data';

  /**
   * @var StorageInterface Используемый кеш.
   */
  private $cache;

  /**
   * @var string Ключ, под которым будут храниться данные в кеше.
   */
  private $key;

  /**
   * @var LoaderInterface Проксируемый загрузчик.
   */
  private $loader;

  /**
   * @param StorageInterface $cache Используемый кеш.
   * @param LoaderInterface $loader Проксируемый загрузчик.
   * @param string $key [optional] Ключ, под которым будут храниться данные в 
   * кеше.
   */
  public function __construct(StorageInterface $cache, LoaderInterface $loader, $key = null){
    $this->cache = $cache;
    $this->loader = $loader;
    $this->key = $key;
  }

  /**
   * @return string Ключ, под которым хранятся данные в кеше.
   */
  public function getKey(){
    if(!is_string($this->key)){
      $this->key = self::DEFAULT_KEY;
    }

    return $this->key;
  }

  /**
   * {@inheritdoc}
   */
  public function load(){
    if(!$this->cache->hasItem($this->getKey())){
      $this->cache->setItem($this->getKey(), $this->loader->load());
    }

    return $this->cache->getItem($this->getKey());
  }
}
