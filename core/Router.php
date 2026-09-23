<?php

class Router
{
    private $routes = [];

    public function get($pattern, $callback)
    {
        $this->routes[] = [
            "method" => "GET",
            "pattern" => $pattern,
            "callback" => $callback
        ];
    }

    public function post($pattern, $callback)
    {
        $this->routes[] = [
            "method" => "POST",
            "pattern" => $pattern,
            "callback" => $callback
        ];
    }

    public function dispatch()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        foreach ($this->routes as $route) {

            if ($route["method"] !== $requestMethod) {
                continue;
            }

            if (preg_match($route["pattern"], $requestUri, $matches)) {

                array_shift($matches);

                return call_user_func(
                    $route["callback"],
                    ...$matches
                );
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}