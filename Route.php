<?php

namespace Core;

use \App\Controllers;

class Route
{
    private $__routes  =array();
    public $route_found = false;

    public function __construct()
    {
        $base_url = $this->__getCurrentUri();
        $this->__routes = $this->__explode_url($base_url);
    }

    public function get($url, $controller, $action, $model=null)
    {
        $get_vars = json_decode(json_encode($_GET, JSON_FORCE_OBJECT));
        $this->__execute("GET", $url, $controller, $model, $action, $get_vars);
    }

    public function post($url, $controller, $action, $model=null)
    {
        $post_vars = json_decode(file_get_contents("php://input"));    
        $this->__execute("POST", $url, $controller, $model, $action, $post_vars);
    }

    public function put($url, $controller, $action, $model=null)
    {
        $put_vars = json_decode(file_get_contents("php://input"));
        $this->__execute("PUT", $url, $controller, $model, $action, $put_vars);
    }

    public function delete($url, $controller, $action, $model=null)
    {
        $delete_vars = json_decode(json_encode($_GET, JSON_FORCE_OBJECT));
        $this->__execute("DELETE", $url, $controller, $model, $action, $delete_vars);
    }

    public function check_sucess()
    {
        if(!$this->route_found)
            throw new \Exception("No route matched", 404);
    }

    private function __check_request_type($allowed_type)
    {
        if($_SERVER['REQUEST_METHOD'] != $allowed_type)
        {
            http_response_code(405); 
            die();
        }
    }

    private function __getNamespace()
    {
        return 'App\Controllers\\';
    }

    private function __execute($request_type, $url, $controller, $model, $action, $parameters)
    {
        if($this->__checkUrl($url)) {
            $this->__check_request_type($request_type);
            $class = $this->__getNamespace().$controller;
            $object = new $class();
            $parameters = $this->__inject_params_to_url_params($url, $parameters);
            $object->init($parameters);
            $object->run($action);
            $object->release();
            $this->route_found = true;
        }
    }      
    
    private function __inject_params_to_url_params($url, $parameters)
    {
        $url_array = $this->__explode_url($url);

        for ($i = 0; $i < count($url_array); $i++)
        {
            if(substr($url_array[$i], 0, 1) === '{')
            {
                $param_name = str_replace('{', '', $url_array[$i]);
                $param_name = str_replace('}', '', $param_name);
                $parameters->$param_name = $this->__routes[$i];
            }                
        }

        return $parameters;
    }

    private function __check_action($parameters)
    {
        return isset($parameters["action"]);
    }

    private function __checkUrl($url)
    {
        $url_array = $this->__explode_url($url);

        if(count($url_array) != count($this->__routes))
            return false;

        for ($i = 0; $i < count($url_array); $i++)
            if(substr($url_array[$i], 0, 1) != '{' && $this->__routes[$i] != $url_array[$i])
                return false;

        return true;
    }

    private function __getCurrentUri()
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    private function __explode_url($url)
    {
        $array = explode('/', $url);
        foreach($array as $route)
            if(trim($route) != '')
                array_push($array, $route);
        return $array;
    }
}