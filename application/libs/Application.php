<?php

class Application {

    private $url_controller = null;
    private $url_action = null;
    private $url_parameter_1 = null;
    private $url_parameter_2 = null;


    public function __construct() {

        $this->splitUrl();
        if ($this->url_controller) {
            if ( file_exists(CONTROLLER_PATH . $this->url_controller . '.php') ) {

            require CONTROLLER_PATH . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();
            // check for controller: does such a controller exist ?
                // check for method: does such a method exist in the controller ?
                if ($this->url_action) {
                    if (method_exists($this->url_controller, $this->url_action)) {
                        // call the method and pass the arguments to it
                        if (isset($this->url_parameter_2)) {
                            $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                        } elseif (isset($this->url_parameter_1)) {
                            $this->url_controller->{$this->url_action}($this->url_parameter_1);
                        } else {
                            // if no parameters given, just call the method without arguments
                            $this->url_controller->{$this->url_action}();
                        }
                    } else {
                        // redirect user to error page (there's a controller for that)
                        header('location: ' . URL . 'error/index');
                    }
                } else {
                    // default/fallback: call the index() method of a selected controller
                    $this->url_controller->index();
                }
            // obviously mistyped controller name, therefore show 404
            } else {
                // redirect user to error page (there's a controller for that)
                header('location: ' . URL . 'error/index');
            }
        // if url_controller is empty, simply show the main page (index/index)
        } else {
            // invalid URL, so simply show home/index
            require CONTROLLER_PATH . 'index.php';
            $controller = new Index();
            $controller->index();
        }
            //require './application/controller/home.php';
            //$home = new Home();
            //$home->index();
     }
    

    public function splitUrl() {
        if ( isset($_GET['url']) ) {

            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);


            $this->url_controller = ( isset($url[0]) ? $url[0] : null );
            $this->url_action = ( isset($url[1]) ? $url[1] : null );
            $this->url_parameter_1 = ( isset($url[2]) ? $url[2] : null );
            $this->url_parameter_2 = ( isset($url[3]) ? $url[3] : null );

        }
    }
}



