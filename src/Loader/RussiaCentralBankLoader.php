<?php
namespace Bricks\Business\Currency\Loader;

use RuntimeException;

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
    $ch = curl_init($this->getUri());
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_AUTOREFERER, true );
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 120 );
    curl_setopt($ch, CURLOPT_MAXREDIRS, 100 );
    $content = curl_exec($ch);
    if(curl_errno($ch)){
      $exc = new RuntimeException(curl_error($ch));
      curl_close($ch);
      throw $exc;
    }
    else{
      curl_close($ch);
      return $content;
    }
  }
}
