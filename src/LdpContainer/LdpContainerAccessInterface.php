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

namespace Esmero\EsmeroLdp\LdpContainer;

use Pimple\Container;


interface LdpContainerAccessInterface
{


    /**
     * Gets an LDP Container Object for a IRI/URI
     *
     * @param string $iri
     *
     * @throws \Exception
     *
     * @return LdpContainerInterface
     */
    public function get($iri);

    /**
     * Sets an LDP Container Object to an IRI/URI
     *
     * @param string $iri
     *
     * @throws \Exception
     *
     * @return LdpContainerInterface
     */
    public function set($iri, LdpContainerInterface $theldpresource);

}