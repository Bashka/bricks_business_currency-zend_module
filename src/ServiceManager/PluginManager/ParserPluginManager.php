<?php
namespace Bricks\Business\Currency\ServiceManager\PluginManager;

use RuntimeException;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\ServiceManager\Factory\InvokableFactory;
use Bricks\Business\Currency\Parser\ParserInterface;
use Bricks\Business\Currency\Parser\RussiaCentralBankXmlParser;

/**
 * @author Artur Sh. Mamedbekov
 */
class ParserPluginManager extends AbstractPluginManager{
  /**
   * {@inheritdoc}
   */
  protected $aliases = [
    'cbr' => RussiaCentralBankXmlParser::class,
  ];

  /**
   * {@inheritdoc}
   */
  protected $factories = [
    RussiaCentralBankXmlParser::class => InvokableFactory::class,

    // v2 normalized FQCNs
    'bricksbusinesscurrencyparserrussiacentralbankxmlparser' => InvokableFactory::class,
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
  protected $instanceOf = ParserInterface::class;

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
