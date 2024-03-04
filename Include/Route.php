<?php
class Route
{
    private static $routes = array();

    /**
     * Add a route to the routing table
     * @param string $uri
     * @param string $controller
     * @param string $method
     * @param array $params
     */
    public static function add($uri, $controller, $method, $params = array())
    {
        self::$routes[$uri] = array('controller' => $controller, 'method' => $method, 'params' => $params);
    }

    /**
     * Launch the router
     * It will check the current uri and call the corresponding controller and method
     */
    public static function launch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $uri = parse_url($uri, PHP_URL_PATH);

        if (empty($uri)) {
            $uri = '/';
        }


        $controller = '';
        $method = '';
        $params = array();
        $found = false;
        foreach (self::$routes as $routeUrl => $route) {
            // 'test/[id]/[nom]'
            $pregString = preg_replace('#\[([a-z]+)\]#', '([a-zA-Z0-9-_]+)', $routeUrl);

            if (preg_match("#^$pregString$#", $uri, $matches)) {
                // var_dump($matches);
                $found = true;
                $controller = $route['controller'];
                $method = $route['method'];
                $params = $route['params'];
                $params['matches'] = self::matchParams($routeUrl, $matches);
                break;
            }
        }

        if (!$found) {
            view('404');
        }else{

            if (isset($params['auth']) && $params['auth'] == true) {
                if (!Auth::isLogged()) {
                    view('403');
                    exit;
                }
            }


            $controllerName = ucfirst($controller.'Controller');
            try {
                $controller = new $controllerName();
                if (!empty($params)) {
                    $controller->$method($params);
                }else{
                    $controller->$method();
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
                echo '<br>';
                echo $th->getTraceAsString();
                echo '<br>';
                echo "For route '$uri' :  controller -> method : " . $controllerName . '->' . $method . " not found";
                exit;
            }
           
            
        }
       
    }

    /**
     * MatchParams
     * Match the parameters of the route with the url
     * @param string $routeUrl
     * @param array $matches
     * @return array
     * 
     */
    public static function matchParams($routeUrl, $matches){
        $params = [];
        $routeUrl = explode('/', $routeUrl);
        foreach ($routeUrl as $key => $value) {
            if (preg_match('#\[([a-z]+)\]#', $value, $match)) {
                $params[$match[1]] = $matches[$key];
            }
        }
        return $params;
    }
}
