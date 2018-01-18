<?php
    class Router{

        private $controller;
        private $method;
        private $parameters;

        public function run() {
            $path = explode("index.php",$_SERVER['PHP_SELF']);
            
            $path = end($path);
           
            if(!empty($path)){
                //Explodes the path and removes the first element from array
                $path = explode('/',$path);
                array_shift($path);
                 
                //Concatenate the word Controller and set the controller
                $this->controller = ucfirst($path[0]).'Controller';
                array_shift($path);
                        
                //Set the method executed by current controller
                if(isset($path[0]) && !empty($path[0])){
                    $this->method = $path[0];
                    array_shift($path);
                }

                //Get all parameters
                while(isset($path[0]) && !empty($path[0])){
                    $this->parameters[] = $path[0];
                    array_shift($path);
                }


                //Get parameters received via POST
                if(isset($_POST) && !empty($_POST)){
                    $this->parameters[] = $_POST;
                }
            } else {//Defines the default controller
                $this->controller = 'HomeController';
                $this->method = "index";
                
            }
            
            //Verify if all information has been setted correctly
            if(isset($this->controller) && !empty($this->controller)){
                if(isset($this->method) && !empty($this->method)){
                    $method = $this->method;
                }else{
                    $method = "index";
                }
                if(!isset($this->parameters) || empty($this->parameters)){
                    $this->parameters = array();
                }

                //Request a controller and call the method
                if(file_exists(ABSOLUTE_PATH.'/controllers/'.$this->controller.'.php') && method_exists(new $this->controller(), $method)) {
                    $c = new $this->controller();
                    $c->$method($this->parameters);
                } else {
                    $error = new ErrorController();
				    $error->notFound();
                }

            }        
        }
    }
