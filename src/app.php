<?php
/**
 * This file is one tiny part of Esmero
 *
 *  (c) 2017. Diego Pino Navarro <dpino@metro.org>
 *  EsmeroLdp https://github.com/esmero/esmero-ldp
 *
 *  This source file is subject to the MIT license that is bundled
 *  with this source code in the file LICENSE.
 *
 */

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Sorien\Provider\PimpleDumpProvider;
use Esmero\EsmeroLdp\Provider\EsmeroLdpServiceProvider;

/**
 * Defines the Application Root. Can be used for storage, assets and even
 * Caching. Just name it.
 */
define("APPROOT", __DIR__ . "/../");

// @TODO Add my old YAML loader and make it better. Words like Ultra are so me.

$app = new Application();

$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

// Can be ignored, only used to allow IDE integration
$app->register(new PimpleDumpProvider());
$app->register(new EsmeroLdpServiceProvider('lpd'));

// Twig templating setup
$app['twig'] = $app->extend(
  'twig',
  function ($twig, $app) {
      return $twig;
  }
);

return $app;