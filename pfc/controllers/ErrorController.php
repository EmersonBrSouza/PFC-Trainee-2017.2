<?php

    class ErrorController extends MainController{
        //Loads not found page
        public function index(){
            $this->notFound();
        }
        
        //Loads denied access page
        public function accessDenied(){
            $this->loadContent('accessDenied');
        }

        //Loads not found page
        public function notFound(){
            $this->loadContent('notFound');
        }
    }