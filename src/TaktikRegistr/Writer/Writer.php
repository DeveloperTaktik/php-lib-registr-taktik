<?php

declare(strict_types=1);

namespace TaktikRegistr\Writer;

class Writer
{

    /** @var string */
    private $url;

    /** @var string */
    private $method;

    /** @var string */
    private $version;

    /** @var bool */
    private $dev;

    /** @var bool */
    private $checkHeaders;

    /** @var array */
    private $headers;

    /** @var array */
    private $body;

    public function __construct(
        string $url,
        string $method,
        string $version,
        bool $dev,
        array $headers = [],
        array $body = []
    ) {
        $this->url = $url;
        $this->method = $method;
        $this->version = $version;
        $this->dev = $dev;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function write()
    {
        $host = $this->dev ? 'http://registr-etaktik.test/' : 'https://registr.etaktik.cz/';
        $url = $host . $this->version . '/' . $this->url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        if (!empty($this->headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }
        if (!empty($this->body)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->body));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $output = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        $header = explode("\r\n", $header);
        if ($header[0] === 'HTTP/1.1 200 OK' || $header[0] === 'HTTP/1.1 201 Created') {
            $output = $body;
        } else {
            $output = json_encode(['errorCode' => (int)explode(' ', $header[0])[1]]);
        }

        curl_close($ch);
        return $output;
    }
}
