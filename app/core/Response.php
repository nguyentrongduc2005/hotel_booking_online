<?php

namespace app\core;


class Response
{
    protected $data;
    protected $statusCode;
    protected $headers = [];
    protected $contentType = 'application/json';
    protected $redirectUrl = null;



    public function __construct($data = null, $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->headers['Content-Type'] = $this->contentType;
    }

    public function json($data, $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->headers['Content-Type'] = 'application/json';
        return $this;
    }

    public function error($message, $statusCode = 400, $stack = null)
    {
        $this->data = [
            'statusCode' => $statusCode,
            'error' => $message,
            'trace' => $stack

        ];
        $this->statusCode = $statusCode;

        $this->headers['Content-Type'] = 'application/json';
        return $this;
    }

    public function redirect($url, $statusCode = 302)
    {
        $this->redirectUrl = $url;
        $this->statusCode = $statusCode;
        $this->headers['Location'] = $url;
        return $this;
    }

    public function send()
    {
        // Thiết lập mã trạng thái
        http_response_code($this->statusCode);

        // Gửi tiêu đề
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        // Nếu là chuyển hướng, không gửi dữ liệu
        if ($this->redirectUrl) {
            return;
        }

        // Gửi dữ liệu
        if ($this->headers['Content-Type'] === 'application/json') {
            echo json_encode($this->data);
        } else {
            echo $this->data;
        }
    }
}
