<?php

namespace Myckhel\Mono\Traits;
/**
 *
 */
trait Config
{
  static function config(String $config = null) {
    return config("mono".($config ? '.'.$config : ''));
  }
}
