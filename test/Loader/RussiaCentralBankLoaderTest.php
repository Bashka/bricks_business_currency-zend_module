<?php
namespace Bricks\Business\Currency\UnitTest\Loader;

use Bricks\Business\Currency\Loader\RussiaCentralBankLoader;

/**
 * @author Artur Sh. Mamedbekov
 */
class RussiaCentralBankLoaderTest extends \PHPUnit_Framework_TestCase{
  const FILE = 'http://www.cbr.ru/scripts/XML_daily.asp';

  public function testLoad(){
    $loader = new RussiaCentralBankLoader(self::FILE);

    $this->assertEquals(file_get_contents(self::FILE), $loader->load());
  }

  public function testGetUri(){
    $loader = new RussiaCentralBankLoader(self::FILE);

    $this->assertEquals(self::FILE, $loader->getUri());
  }

  public function testGetUri_shouldReturnDefaultUriIfNotSet(){
    $loader = new RussiaCentralBankLoader;

    $this->assertEquals(RussiaCentralBankLoader::DEFAULT_URI, $loader->getUri());
  }
}
