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

use Exception;


/**
 * Interface LdpContainerInterface
 *
 * Defines a general LDP Container Object Interface
 *
 * @package Esmero\EsmeroLdp\LdpContainer
 */
interface LdpContainerInterface
{

    const DEFAULTFRAMEDJSONLD = '
    { "@context": {
    "ldp": "http://www.w3.org/ns/ldp#",
    "xsd": "http://www.w3.org/2001/XMLSchema#",
    "modified":
    {
      "@id": "http://purl.org/dc/terms/modified",
      "@type": "http://www.w3.org/2001/XMLSchema#dateTime"
    },
    "dc": "http://purl.org/dc/elements/1.1/",
    "label": "http://www.w3.org/2000/01/rdf-schema#label" 
    },
     "@graph": [
    {
      "@id": "<>",
      "@type": "RDFSource"
    }
    ]}';

    const DEFAULTJSONLD = '
    { "@context": {
    "ldp": "http://www.w3.org/ns/ldp#",
    "xsd": "http://www.w3.org/2001/XMLSchema#",
    "modified":
    {
      "@id": "http://purl.org/dc/terms/modified",
      "@type": "http://www.w3.org/2001/XMLSchema#dateTime"
    },
    "dc": "http://purl.org/dc/elements/1.1/",
    "label": "http://www.w3.org/2000/01/rdf-schema#label" 
    },    
      "@id": "<>",
      "@type": "ldp:RDFSource"
    }';




    /**
     * Defines RDF Source Document. In LDP everything is an ldp#Resource!
     */
    const LDPRS = array("ldp:RDFSource");

    /**
     * Defines Non RDF Source Interaction Model.
     */
    const LDPNR = array("ldp:NonRDFSource");

    /**
     * Defines Basic Containment Model.
     * @see https://www.w3.org/TR/ldp/#dfn-linked-data-platform-container
     *
     * Even if materializaing LDPRS rdf type for containers is not required
     * we do it anyway, since we don't want to impose a smart client (infer)
     */
    const LDPBC = array("ldp:BasicContainer") + self::LDPRS;

    /**
     * Defines Direct Containment Model
     */
    const LDPDC = array("ldp:DirectContainer") + self::LDPRS;

    /**
     * Defines Indirect Containment Model
     */
    const LDPIC = array("ldp:IndirectContainer") + self::LDPRS;


    /**
     * Gets an LDP Object's Id
     *
     * @throws Exception
     *
     * @return string
     */
    public function getURL();


    /**
     * Gets an LDP Object's Attributes
     *
     * @throws Exception
     *
     * @return array
     */
    public function getTriples();

    /**
     * @param \JsonSerializable $triples
     *
     * @return LdpDocument
     */
    public function setTriples(\JsonSerializable $triples);


}