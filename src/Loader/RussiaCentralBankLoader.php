<?php
namespace Bricks\Business\Currency\Loader;

/**
 * @author Artur Sh. Mamedbekov
 */
class RussiaCentralBankLoader implements LoaderInterface{
  const DEFAULT_URI = 'http://www.cbr.ru/scripts/XML_daily.asp';

  /**
   * @var string Адрес источника.
   */
  private $uri;

  /**
   * @param string $uri [optional] Адрес источника. Если не указан, используется 
   * значение константы DEFAULT_URI.
   */
  public function __construct($uri = null){
    $this->uri = $uri;
  }

  /**
   * @return string Адрес источника.
   */
  public function getUri(){
    if(!is_string($this->uri)){
      $this->uri = self::DEFAULT_URI;
    }

    return $this->uri;
  }

  /**
   * {@inheritdoc}
   */
  public function load(){
    return file_get_contents($this->getUri());
  }
}
