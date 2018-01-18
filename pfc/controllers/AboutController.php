<?php
    class AboutController extends MainController{

        //Loads the about page
        public function index(){
            $this->loadContent('about');
        }
    }
