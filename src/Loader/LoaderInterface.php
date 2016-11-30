<?php
namespace Bricks\Business\Currency\Loader;

/**
 * @author Artur Sh. Mamedbekov
 */
interface LoaderInterface{
  /**
   * @return string Данные о котировках валютных пар.
   */
  public function load();
}
