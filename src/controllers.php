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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Esmero\EsmeroLdp\Provider\EsmeroLdpControllerProvider;


$app->mount('/', new EsmeroLdpControllerProvider());


$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
