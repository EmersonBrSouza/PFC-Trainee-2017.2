<?php

    class Member implements JsonSerializable{
        
        private $name;
        private $personal_email;
        private $professional_email;
        private $rg;
        private $cpf;
        private $password;
        private $birthdate;
        private $telephone;
        private $marital_status;
        private $member_type;
        private $score;
        private $profile_picture;

        public function __construct($name,$personal_email,$professional_email,$rg,$cpf,$password,$birthdate,$telephone,$marital_status,
                                    $member_type,$score,$profile_picture){
            
            $this->name = $name;
            $this->personal_email = $personal_email;
            $this->professional_email = $professional_email;
            $this->rg = $rg;
            $this->cpf = $cpf;
            $this->password = $password;
            $this->birthdate = $birthdate;
            $this->telephone = $telephone;
            $this->marital_status = $marital_status;
            $this->member_type = $member_type;
            $this->score = $score;
            $this->profile_picture = $profile_picture;
        }

        public function getName(){
            return $this->name;
        }

        public function getPersonalEmail(){
            return $this->personal_email;
        }

        public function getProfessionalEmail(){
            return $this->professional_email;
        }

        public function getRG(){
            return $this->rg;
        }

        public function getCPF(){
            return $this->cpf;
        }

        public function getPassword(){
            return $this->password;
        }
        public function getBirthdate(){
            return $this->birthdate;
        }

        public function getTelephone(){
            return $this->telephone;
        }

        public function getMaritalStatus(){
            return $this->marital_status;
        }

        public function getMemberType(){
            return $this->member_type;
        }

        public function getScore(){
            return $this->score;
        }

        public function getProfilePicture(){
            if($this->profile_picture == "not_found"){
                return ROOT_URL.'media/profile/default.svg';
            }else{
                return $this->profile_picture;
            }
        }

        public function jsonSerialize(){
            return [
                "name"=>$this->name,
                "personal_email"=>$this->personal_email,
                "professional_email"=>$this->professional_email,
                "rg"=>$this->rg,
                "cpf"=>$this->cpf,
                "birthdate"=>$this->birthdate,
                "telephone"=>$this->telephone,
                "marital_status"=>$this->marital_status,
                "member_type"=>$this->member_type,
                "score"=>$this->score,
                "profile_picture"=>$this->profile_picture,
            ];
        }
    }