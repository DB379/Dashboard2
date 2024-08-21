<?php

class Router
{
    private $handlers;
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function get(string $path, $callback)
    {
        $this->addHandler(self::METHOD_GET, $path, $callback);
    }

    public function post(string $path, $callback)
    {
        $this->addHandler(self::METHOD_POST, $path, $callback);
    }

    private function addHandler(string $method, string $path, $callback)
    {
        $this->handlers[$method . $path] = [
            'callback' => $callback
        ];
    }

    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $callback = $this->handlers[$requestMethod . $requestUri]['callback'] ?? null;

        if (!$callback) {
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
            return;
        }

        call_user_func($callback);
    }
}
