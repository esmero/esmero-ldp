<?php
/**
 * This file is one tiny part of Esmero
 *
 *  (c) 2017. Diego Pino Navarro
 *  EsmeroLdp https://github.com/esmero/esmero-ldp
 *
 *  This source file is subject to the MIT license that is bundled
 *  with this source code in the file LICENSE.
 *
 */

namespace Esmero\EsmeroLdp\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class EsmeroLdpControllerProvider implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app) {

        $normalizePath = function ($ldppath, Request $request) use ($app) {
            return $this->normalizePath($ldppath);
        };

        $controllers = $app['controllers_factory']
        ->assert('ldppath','.+')
        ->value('ldppath', '')
        ->convert('ldppath', $normalizePath);

        $controllers->get("/{ldppath}","ldp.restcontroller:get");
        $controllers->post("/{ldppath}","ldp.restcontroller:post");
        $controllers->put("/{ldppath}", "ldp.restcontroller:put");
        $controllers->delete("/{ldppath}", "ldp.restcontroller:delete");
        $controllers->options("/{ldppath}","ldp.restcontroller:options");
        $controllers->patch("/{ldppath}","ldp.restcontroller:patch");
        $controllers->match("/{ldppath}","ldp.restcontroller:head")->method('HEAD');
        return $controllers;

    }

    private function normalizePath($ldppath) {
        $ldppath = rtrim($ldppath, '/') . '/';
        return $ldppath;
    }

}
