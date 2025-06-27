<?php
// core/Request.php
namespace app\core;

class Request
{
    protected $params = [];
    protected $query = [];
    protected $input = [];
    protected $files = [];
    protected $payload = null;
    protected $method;
    protected $path;
    protected $headers = [];


    public function __construct()
    {

        $basePath = Registry::getInstance()->config['basePath'];

        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $url = parse_url($url, PHP_URL_PATH);
        $url = rtrim(str_replace($basePath, '', $url), '/');
        // echo $url;

        $this->path = $url === '' || empty($url) ? '/' : $url;

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->query = $_GET;
        $this->input = $_POST;
        $this->files = $_FILES;
        $this->headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $this->parsePayload();
    }

    // Lấy tất cả tham số route
    public function params()
    {
        return $this->params;
    }

    // Lấy một tham số route cụ thể
    public function param($key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }

    // Gán tham số route (dùng trong Router)
    public function setParams($params)
    {
        $this->params = $params;
        return $this->params;
    }

    // Lấy query string
    public function query($key = null, $default = null)
    {
        if ($key === null) {
            return $this->query;
        }
        return $this->query[$key] ?? $default;
    }

    // Lấy dữ liệu POST
    public function post($key = null, $default = [])
    {
        if ($key === null) {
            return $this->input;
        }
        return $this->input[$key] ?? $default;
    }

    // Lấy dữ liệu từ body (JSON payload)
    public function payload($key = null, $default = null)
    {
        if ($this->payload === null) {
            return $default;
        }
        if ($key === null) {
            return $this->payload;
        }
        return $this->payload[$key] ?? $default;
    }

    // Lấy tất cả input (gộp query, post, payload)
    public function all()
    {
        return array_merge($this->query, $this->input, $this->payload ?? []);
    }

    // Lấy một số key cụ thể
    // public function only(array $keys)
    // {
    //     return array_intersect_key($this->all(), array_flip($keys));
    // }

    // // Lấy tất cả trừ một số key
    // public function except(array $keys)
    // {
    //     return array_diff_key($this->all(), array_flip($keys));
    // }

    // Lấy input bất kỳ (query, post, hoặc payload)
    public function input($key = null, $default = null)
    {
        $data = $this->all();
        if ($key === null) {
            return $data;
        }
        return $data[$key] ?? $default;
    }

    // Lấy file upload
    public function file($key, $default = null)
    {
        return $this->files[$key] ?? $default;
    }

    // Lấy header
    public function header($key, $default = null)
    {
        $key = strtolower($key);
        return $this->headers[$key] ?? $default;
    }

    // Lấy method
    public function method()
    {
        return $this->method;
    }

    // Lấy path
    public function path()
    {
        return $this->path;
    }

    // Kiểm tra method
    public function isMethod($method)
    {
        return strtolower($method) === $this->method;
    }

    // Kiểm tra có key trong input
    public function has($key)
    {
        return array_key_exists($key, $this->all());
    }

    // Xử lý JSON payload từ body
    protected function parsePayload()
    {
        if (in_array($this->method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $contentType = $this->header('Content-Type', '');
            if (stripos($contentType, 'application/json') !== false) {

                //php://input là một stream đặc biệt trong PHP, cho phép đọc dữ liệu thô (raw data) từ body của yêu cầu HTTP.
                $rawData = file_get_contents('php://input');
                $this->payload = json_decode($rawData, true) ?? [];
            }
        }
    }
}
