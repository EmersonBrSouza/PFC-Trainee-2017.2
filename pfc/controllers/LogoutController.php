<?php

    class LogoutController extends MainController{

        //Destroy the session
        public function index(){
            session_destroy();
            $this->redirect('home',array());
        }
    }