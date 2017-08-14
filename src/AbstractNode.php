<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi;

/**
 * abstract node
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     * urlencoded content type
     * @const array URLENCODED_CONTENT_TYPE
     */
    const URLENCODED_CONTENT_TYPE = [
        'Content-Type' => 'application/x-www-form-urlencoded',
    ];

    /**
     * json content type
     * @const array JSON_CONTENT_TYPE
     */
    const JSON_CONTENT_TYPE = [
        'Content-Type' => 'application/json',
    ];

    /**
     * client
     * @var \Unikorp\KongAdminApi\Client $client
     */
    private $client = null;

    /**
     * Constructor
     *
     * @param \Unikorp\KongAdminApi\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * get
     *
     * @param string $endpoint
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function get($endpoint, DocumentInterface $document = null)
    {
        return $this->client->getHttpClient()->get(
            sprintf('%1$s?%2$s', $endpoint, $document ? $document->toQueryString() : ''),
            self::URLENCODED_CONTENT_TYPE
        );
    }

    /**
     * post
     *
     * @param string $endpoint
     * @param DocumentInterface $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function post($endpoint, DocumentInterface $document = null)
    {
        return $this->client->getHttpClient()->post(
            $endpoint,
            self::JSON_CONTENT_TYPE,
            $document ? $document->toJson() : '[]'
        );
    }

    /**
     * put
     *
     * @param string $endpoint
     * @param DocumentInterface $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function put($endpoint, DocumentInterface $document = null)
    {
        $document->setCreatedAt(time());

        return $this->client->getHttpClient()->put(
            $endpoint,
            self::JSON_CONTENT_TYPE,
            $document ? $document->toJson() : '[]'
        );
    }

    /**
     * patch
     *
     * @param string $endpoint
     * @param DocumentInterface $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function patch($endpoint, DocumentInterface $document = null)
    {
        return $this->client->getHttpClient()->patch(
            $endpoint,
            self::JSON_CONTENT_TYPE,
            $document ? $document->toJson() : '[]'
        );
    }

    /**
     * delete
     *
     * @param string $endpoint
     * @param DocumentInterface $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function delete($endpoint, DocumentInterface $document = null)
    {
        return $this->client->getHttpClient()->delete(
            $endpoint,
            self::JSON_CONTENT_TYPE,
            $document ? $document->toJson() : '[]'
        );
    }
}
