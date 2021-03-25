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
        $host = $this->dev ? 'https://dev-registr.etaktik.cz/' : 'https://registr.etaktik.cz/';
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

        $arrConfirm = [
            200 => 'HTTP/1.1 200 OK',
            201 => 'HTTP/1.1 201 Created',
            226 => 'HTTP/1.1 226 IM Used'
        ];
        if (in_array($header[0], $arrConfirm)) {
            $body = json_decode($body);
            if (empty($body)) {
                $body = new \stdClass();
            }
            $body->successCode = array_keys($arrConfirm, $header[0])[0];
            $body = json_encode($body);
            $output = $body;
        } else {
            $output = json_encode(['errorCode' => (int)explode(' ', $header[0])[1]]);
        }

        curl_close($ch);
        return $output;
    }
}
