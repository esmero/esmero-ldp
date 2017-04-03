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

namespace Esmero\EsmeroLdp\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Esmero\EsmeroLdp\LdpContainer\LdpDocument;

class LdpRestController
{
    public function get(Application $app, Request $request, $ldppath)
    {
        // We could use $request->getPathInfo() but it would not be normalized

        // Stub for now:
        // Depending on the interaction Esmero\EsmeroLdp\LdpContainer\LdpDocument
        // And the Persistent Storage Provider
        // The correct Mime Type and Payload to give back will be provided transparently
        $doc = NULL;

        $fullURL = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $ldppath;
        $jsonLD = new LdpDocument($fullURL, $doc);

        if (0 === strpos($request->headers->get('Accept'), 'text/html')) {

            $response = new Response($jsonLD, 200, [
              'Link' => 'http://www.w3.org/ns/ldp#Resource; rel="type"'
            ]);
            $jsonld = $jsonLD->__toString();
            return $app['twig']->render('index.html.twig', ['jsonld' => $jsonld], $response);
        }

        $response = new Response($jsonLD->__toString(), 200, [
          'Link' => 'http://www.w3.org/ns/ldp#Resource; rel="type"',
          'Content-Type' => 'application/ld+json'
        ]);
        // @TODO return the payload serialized according to Accept request

        return $response;
    }


    public function post(Application $app, Request $request, $ldppath)
    {
        // We will need some extra logic here. Fedora4 way of creating Basic Containers for
        // Any RDFSource is bad. BasicContainers should be explicly requested
        // And the default should be a RDFSource which would then never contain

        // @TODO Slug / v/s minter. Minters should be plugable

        $response = new Response('OK', 200, ['Link: http://www.w3.org/ns/ldp#Resource; rel="type']);

        return $response;
    }


    public function put(Application $app, Request $request, $ldppath)
    {

        $response = new Response('OK', 200, ['Link: http://www.w3.org/ns/ldp#Resource; rel="type']);

        return $response;
    }


    public function patch(Application $app, Request $request, $ldppath)
    {
        $response = new Response('OK', 200, ['Link: http://www.w3.org/ns/ldp#Resource; rel="type']);

        return $response;
    }


    public function delete(Application $app, Request $request, $ldppath)
    {
        // Probably needs to discussed. Fedora4 as today, makes any RDFSource also a Basic Container
        // Which according to https://www.w3.org/TR/ldp/#ldpc is not correct

        // This means that when deleting, a RDFSource can safely deleted (we can define tombstone concept)
        // But a container needs a different interaction. Will it act as an rm -rf?

        $response = new Response('OK', 200, ['Link: http://www.w3.org/ns/ldp#Resource; rel="type']);

        return $response;
    }

    public function head(Application $app, Request $request, $ldppath)
    {
        $response = new Response('OK', 200, ['Link: http://www.w3.org/ns/ldp#Resource; rel="type']);

        return $response;
    }

    public function options(Application $app, Request $request, $ldppath)
    {
        $response = new Response('OK', 200, ['Link: http://www.w3.org/ns/ldp#Resource; rel="type']);

        return $response;
    }
}