<?php
    namespace Base;

    class Router{
        private static array $routes = array();

        public static function add(string $method, string $path, string $controller, string $function, array $middlewares = []):void{
            self::$routes[] = [
                "method"=> $method,
                "path"=> $path,
                "controller" => $controller,
                "function"=> $function,
                "middlewares" => $middlewares
            ];
        }

        public static function run(){

            $path = $_SERVER["PATH_INFO"] ?? '/';
            $method = $_SERVER["REQUEST_METHOD"];

            foreach(self::$routes as $route){

                $pattern = "#^" . $route["path"] . "$#";
                if(preg_match($pattern, $path, $variables) && $route["method"] == $method){
                    
                    $controller = new $route["controller"];
                    $function = $route["function"];

                    foreach($route['middlewares'] as $middleware){
                        $instance = new $middleware();
                        $instance->before(); 
                    }

                    array_shift($variables);
                    call_user_func_array([$controller, $function], $variables);
                    return;
                }
            }

            return json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Resource not found'
            ]);
        }
    }