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

/**
 * Class LdpDocument
 *
 * Defines a general LDP Document class
 *
 * @package Esmero\EsmeroLdp\LdpContainer
 */
class LdpDocument implements LdpContainerInterface
{

    protected $triples = NULL;

    protected $payload;

    protected $url;

    protected $interactionModel = array();

    protected $directChildren = array();

    /**
     * LdpDocument constructor.
     * @param $url
     */
    public function __construct($url = "<>", $triples =  NULL)
    {
        $this->url = $url;
        $this->triples = !empty($triples) ? json_decode($triples) : json_decode(self::DEFAULTJSONLD);
        $this->payload = json_decode(self::DEFAULTFRAMEDJSONLD );
        $this->payload->{'@graph'}[0]->{'@id'} = $url;
        $this->triples->{'@id'} = $url;
        $this->triples->{'label'} = 'Some Label';

    }


    /**
     * @return mixed
     */
    public function getTriples()
    {
        return $this->triples;
    }

    /**
     * @param \JsonSerializable $triples
     *
     * @return LdpDocument
     */
    public function setTriples(\JsonSerializable $triples)
    {
        $this->triples = $triples;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     * @return LdpDocument
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return LdpDocument
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function getInteractionModel(): array
    {
        return $this->interactionModel;
    }

    /**
     * @param array $interactionModel
     * @return LdpDocument
     */
    public function setInteractionModel(array $interactionModel): LdpDocument
    {
        $this->interactionModel = $interactionModel;

        return $this;
    }

    /**
     * @return array
     */
    public function getDirectChildren(): array
    {
        return $this->directChildren;
    }

    /**
     * @param array $directChildren
     * @return LdpDocument
     */
    public function setDirectChildren(array $directChildren): LdpDocument
    {
        $this->directChildren = $directChildren;

        return $this;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return (json_encode($this->triples, JSON_UNESCAPED_UNICODE));

    }


}