<?php

    class Project{
        private $id;
        private $title;
        private $clientName;
        private $paymentMethod;
        private $duration;
        private $price;
        private $status;


        public function __construct($id, $title,$clientName,$paymentMethod,$duration,$price,$status){
            $this->id = $id;
            $this->title = $title;
            $this->clientName = $clientName;
            $this->paymentMethod = $paymentMethod;
            $this->duration = $duration;
            $this->price = $price;
            $this->status = $status;
        }

        public function getID(){
            return $this->id;
        }

        public function getTitle(){
            return $this->title;
        }

        public function getClientName(){
            return $this->clientName;
        }

        public function getPaymentMethod(){
            return $this->paymentMethod;
        }

        public function getDuration(){
            return $this->duration;
        }

        public function getPrice(){
            return $this->price;
        }
        
        public function getStatus(){
            return $this->status;
        }
    }