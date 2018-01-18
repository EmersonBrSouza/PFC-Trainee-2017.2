<?php

    class LoginController extends MainController{

        //Loads the login page
        public function index(){
            if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']){
                $this->redirect('home');
                return;
            }

            if(isset($_POST) && !empty($_POST)){
                if($this->loginCorrect($_POST['email'],$_POST['password'])){
                    $this->redirect('home');
                }else{
                   $this->data['error'] = "E-mail e/ou senha incorretos.";
                   $this->loadContent('login',$this->data); 
                }
            }else{
                $this->loadContent('login',array());
            }
        }

        //Verify if login data is correct
        public function loginCorrect($email,$password){

            $memberDAO = new MemberDAO();
            $fields = array("name,personal_email,password,member_type,cpf");
            $filters = array("personal_email"=>$email);
            $member = $memberDAO->retrieve($fields,$filters);

            if(count($member) == 1){
                if(password_verify($password,$member[0]->getPassword())){
                    $_SESSION['isLogged'] = true;
                    $_SESSION['name'] = $member[0]->getName();
                    $_SESSION['email'] = $email;
                    $_SESSION['cpf'] = $member[0]->getCPF();
                    $_SESSION['member_type'] = $member[0]->getMemberType();
                    return true;
                }
            }

            return false;
        }
    }