<?php

namespace App\Core;

class Router{
    private array $routes = [];
    private array $params = [];

    public function add(string $route, array $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^}]+)\}/', '(?P<\1>\2)', $route);
        $route = '#^' . $route . '$#i';
        
        $this->routes[$route] = $params;
    }
    
    public function match(string $url): bool
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '';
        
        $baseUrl = '/MVC';
        if (strpos($path, $baseUrl) === 0) {
            $path = substr($path, strlen($baseUrl));
        }
        
        if (empty($path)) {
            $path = '/';
        } elseif ($path[0] !== '/') {
            $path = '/' . $path;
        }
        
        foreach ($this->routes as $route => $params) {
            
            if (preg_match($route, $path, $matches)) {
                if (isset($params['method']) && $params['method'] !== $requestMethod) {
                    error_log("Method mismatch: expected " . $params['method'] . " got " . $requestMethod);
                    continue;
                }
                
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        error_log("No route matched for path: " . $path);
        return false;
    }


    public function getParams(): array
    {
        return $this->params;
    }

    public function get(string $route, string $handler): void
    {
        $params = $this->parseHandler($handler);
        $params['method'] = 'GET';
        $this->add($route, $params);
    }

    public function post(string $route, string $handler): void
    {
        $params = $this->parseHandler($handler);
        $params['method'] = 'POST';
        $this->add($route, $params);
    }

    private function parseHandler(string $handler): array
    {
        [$controller, $action] = explode('@', $handler);
        return [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch(string $url): void
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controller = $this->getControllerName();
            $controller = $this->getNamespace() . $controller;

            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                $action = $this->getActionName();
                
                if (method_exists($controller_object, $action)) {
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action in controller $controller not found");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }

   
    private function getControllerName(): string
    {
        $controller = $this->params['controller'] ?? '';
        return $this->formatControllerName($controller);
    }

   
    private function formatControllerName(string $controller): string
    {
        if (str_ends_with($controller, 'Controller')) {
            return str_replace('-', '', ucwords($controller, '-'));
        }
        return str_replace('-', '', ucwords($controller, '-')) . 'Controller';
    }

    
    private function getActionName(): string
    {
        $action = $this->params['action'] ?? '';
        return lcfirst(str_replace('-', '', ucwords($action, '-')));
    }

   

    private function getNamespace(): string
    {
        return 'App\Controllers\\';
    }

   
    private function removeQueryStringVariables(string $url): string
    {
        if ($url !== '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}