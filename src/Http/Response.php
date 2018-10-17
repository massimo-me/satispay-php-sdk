<?php

namespace ChiarilloMassimo\Satispay\Http;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

/**
 * Class Response.
 */
class Response
{
    const HTTP_NO_CONTENT = 204;
    const HTTP_OK = 200;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var array
     */
    protected $headers;

    /**
     * Response constructor.
     *
     * @param $content
     * @param $statusCode
     * @param array $headers
     */
    public function __construct($content, $statusCode, $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return (int) $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return bool|object
     */
    public function getData()
    {
        if (self::HTTP_NO_CONTENT === $this->statusCode) {
            return false;
        }

        $data = json_decode($this->content);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return false;
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->decode()->code;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->decode()->message;
    }

    /**
     * @param GuzzleResponse $response
     *
     * @return static
     */
    public static function makeFromGuzzleResponse(GuzzleResponse $response)
    {
        return new static(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }
}
