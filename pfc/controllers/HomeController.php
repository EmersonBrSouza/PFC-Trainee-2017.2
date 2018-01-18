<?php
    class HomeController extends MainController{
        //Loads the index page
        public function index(){
            $this->loadContent('index',array());
        }
    }
?>