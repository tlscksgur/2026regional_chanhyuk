<?php

class route {
  static $route = [];
  static function path($reqM, $uri, $hdl) {
    $uri = preg_replace("#\{(.*?)\}#", "([^\/]+)", $uri);
    return self::$route[] = [$reqM, "#^$uri$#", $hdl];
  }

  static function handlerRequest() {
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
    $REQUEST_URI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach(self::$route as $r) {
      [$reqM, $uri, $hdl] = $r;
      if($REQUEST_METHOD !== $reqM) continue;
      if(preg_match($uri, $REQUEST_URI, $matches)) {
        array_shift($matches);
        call_user_func_array($hdl, $matches);
        return 'success';
      }
    }
    move('/');
  }

}

function get($uri, $hdl) {
  route::path('GET', $uri, $hdl);
}

function post($uri, $hdl) {
  route::path('POST', $uri, $hdl);
}