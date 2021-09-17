<?php

namespace app\core;

class Router{

    public Request $request;
    public Response $response;

    protected array $routes = [];       //holds paths and their corresponding callback functions
    //routes STRUCTURE
    // routes = [
    //     'get' = [
    //         'path' = 'method',
    //         'path' = 'method'
    //     ]
    //     'post' = [
    //         'path' = 'method'
    //     ],
    //      'other methods'
    // ]

    /**
     * Router has Response and Request classes as properties
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * function to set given value of callback as function to given path
     * common use - in index page to set routes for get requests
     */
    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;    //add 'path' => 'function' to 'get' array of routes array
    }

    /**
     * function to set given value of callback as function to given path
     * common use - in index page to set routes for post requests
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * resolve a request
     * get path, and run corresponding function from routes array
     */
    public function resolve()
    {
        $path = $this->request->getPath();      //get request path
        $method = $this->request->method();     //get request method
        $callback = $this->routes[$method][$path] ?? false;     //get corresponding function of request path from 'routes' array
        if ($callback === false){               //if false, no path is specified
            $this->response->setStatusCode(404);    //return 404 not found error
            return $this->renderView("_404");
            exit;
        }
        if(is_string($callback)){           //returns if callback is a string
            return $this->renderView($callback);    //then return view with same name as callback string
        }
        if(is_array($callback)){            //if callback is array,ie [Controller::class, 'method']
            Application::$app->controller =  new $callback[0];      //create instance of the given controller. given in callback[0]
            $callback[0] = Application::$app->controller;           //set instance of controller as callback[0]
        }
        return call_user_func($callback, $this->request, $this->response);  //finally run the function

    }

    /**
     * to return a view with layout and parameters
     * @return string of layout and view
     */
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();         //returns contents(HTML) of layout(from this.controller.layout)
        $viewContent = $this->renderOnlyView($view, $params);   //returns contents(HTML) of specified view
        return str_replace('{{ content }}', $viewContent, $layoutContent);      //replace content placeholder from layout with view content
    }

    /**
     * to return view with layout and specified content
     * @param string of contnt 
     * @return string of content embedded in layout
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();    //returns contents(HTML) of layout(from this.controller.layout)
        return str_replace('{{ content }}', $viewContent, $layoutContent);//replace content placeholder from layout with content
    }

    /**
     * returns layout specified in controller
     */
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;    //get the layout name from controller
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";   //include the layout
        return ob_get_clean();          //return contents
    }

    /**
     * @return (array|string) of HTML of specified view with embedded params
     * 
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value){        //extract 'key' => 'value' from params array
            $$key = $value;             //create variable with name of the key and value as value
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";     //include the view. params will be inserted in view file
        return ob_get_clean();      //return view contents
    }
}
?>