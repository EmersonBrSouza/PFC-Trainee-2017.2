<?php
    
    class MemberController extends MainController{

        //This method loads the index of members area
        public function index(){
            if($this->isLogged()){
                $this->loadContent('member_index',array());
            }
        }

        /*This method provides the service to register of the members. The register should be made by directors
        and all fields are required*/
        public function register(){
            if($this->isAdmin()){
                if(isset($_POST) && !empty($_POST)){
                    $memberDAO = new MemberDAO();
                    $member = new Member($_POST['name'],
                                         $_POST['personal_email'],
                                         $_POST['professional_email'],
                                         $_POST['rg'],
                                         $_POST['cpf'],
                                         password_hash($_POST['password'],PASSWORD_DEFAULT),
                                         $_POST['birthdate'],
                                         $_POST['telephone'],
                                         $_POST['marital_status'],
                                         $_POST['member_type'],
                                         $_POST['score'],
                                         $_POST['path_profile_picture']);
                                
                    $memberDAO->insert($member); //Saves the member in database
                    $this->redirect('member'); //Redirect the page
                }else{
                    $this->loadContent('member_register',array());
                }
            }
        }   

        //This method provides the service to update the registers of the members. The update is made by the member
        public function update(){
            if($this->isLogged()){
                if(isset($_POST) && !empty($_POST)){
                    //Save member data 
                    $memberDAO = new MemberDAO();
                    $fields = array("name"=>$_POST['name'],
                                    "professional_email"=>$_POST['professional_email'],
                                    "telephone"=>$_POST['telephone'],
                                    "marital_status"=>$_POST['marital_status'],
                                    "path_profile_picture"=>$_POST['path_profile_picture']);
                    
                    if(!empty($_POST['password_update'])){
                        $fields["password"] = password_hash($_POST['password_update'],PASSWORD_DEFAULT);
                    }

                    $memberDAO->update($fields,array("cpf"=>$_SESSION['cpf']));
                    $this->redirect('member');
                }else{
                    //Loads the data from logged member to the form
                    $memberDAO = new MemberDAO();
                    $fields = array('name,professional_email,telephone,path_profile_picture');
                    $filters = array('cpf'=>$_SESSION['cpf']);
                    $member = $memberDAO->retrieve($fields,$filters);
                    $this->loadContent('member_update',array("0"=>$member[0]));
                }
            }
        }
        
        //This method provides the service of history of the transactions performed by members.
        public function history(){
            if($this->isLogged()){
                $memberDAO = new MemberDAO();
                $fields = array('cpf,path_profile_picture');
                $filters = array();
                $members = $memberDAO->retrieve($fields,$filters);

                if($_SESSION['member_type'] == "director" || $_SESSION['member_type'] == "admin"){
                    $this->data['profiles'] = $members;
                    $this->loadContent('director_history', $this->data['profiles']);
                }
                else{
                    $fields = array('name,personal_email,professional_email,birthdate,telephone,member_type,score,marital_status');
                    $filters = array("cpf"=>$_SESSION['cpf']);                    
                    $member = $memberDAO->retrieve($fields,$filters);
                    $this->data['single_profile'] = $member[0];

                    $historyDAO = new HistoryDAO();
                    $filters = array('member_cpf'=>$_SESSION['cpf']);
                    $history = $historyDAO->retrieve(array(),$filters);
                    $this->data['history'] = $history;

                    $this->loadContent('member_history', $this->data);
                }
            }
        }

        //This method provides the member request 
        public function request(){
            if($this->isLogged()){
                if($_SESSION['member_type'] != "admin" ){
                    if(isset($_POST) && !empty($_POST)){
                    $requestDAO = new RequestDAO();
                    $cpf = $_SESSION['cpf'];
                    $request_id = $requestDAO->insert($cpf,$_POST['request_reason'],'opened');

                    //Save and associate request files
                    $paths = $this->saveRequestFiles();
                    foreach($paths as $path){
                        $requestDAO->associateFile($request_id,$path);    
                    }
                    $this->redirect('member',array());
                    }else{
                        $this->loadContent('member_request');
                    }
                }else{
                    $this->accessDenied();
                }
            }
        }

        //This method provides the director response for a member request
        public function response($request_id){

            $request = $request_id[0];
            
            if($this->isAdmin()){
                if(isset($_POST) && !empty($_POST)){ //Register the refund
                    $value_required = intval($_POST['value_required']);

                    $requestDAO = new RequestDAO();
                    $memberDAO = new MemberDAO();

                    $filters_request = array("request_id"=>$request);
                    $request_response = $requestDAO->retrieve(array(),$filters_request); //Get the request
                    
                    $fields_member = array("score","name");
                    $filters_member = array("cpf"=>$request_response[0]['member_cpf']);
                    $member = $memberDAO->retrieve($fields_member,$filters_member); //Get the member
                    
                    $score = intval($member[0]->getScore());

                    if($value_required < $score){ //Verify if score is sufficient
                        $new_score = $score - $value_required;
                        $data = array("score"=>$new_score);
                        $filters_update = array("cpf"=>$request_response[0]['member_cpf']);
                        
                        $memberDAO->update($data,$filters_update);
                        $requestDAO->update(array("status"=>"accepted"),$filters_request);

                        $historyDAO = new HistoryDAO(); //Add the transaction to member history
                        $historyDAO->insert($request_response[0]['member_cpf'],
                                            $request_response[0]['reason'],
                                            "lose",
                                            $value_required);
                        $this->redirect('member/history');
                    }else{
                        $this->data['error']  = "Saldo insuficiente!";
                        $this->data['member_data'] = array("name"=>$member[0]->getName(),
                                                        "score"=>$member[0]->getScore(),
                                                        "request_reason"=>$request_response[0]['reason'],
                                                        "files"=>$request_response[0]['files']);
                        $this->loadContent('director_response',$this->data);
                    }

                }else{ //Loads the data to view
                    $requestDAO = new RequestDAO();
                    $filters = array("request_id"=>$request);
                    $request_response = $requestDAO->retrieve(array(),$filters);
                    
                    if($request_response[0]['status'] != "opened"){
                        $this->redirect("member/history");
                    }
                    $fields_member = array("score","name");
                    $filters_member = array("cpf"=>$request_response[0]['member_cpf']);

                    $memberDAO = new MemberDAO();
                    $member = $memberDAO->retrieve($fields_member,$filters_member);
                    
                    $this->data['member_data'] = array("name"=>$member[0]->getName(),
                                                        "score"=>$member[0]->getScore(),
                                                        "request_reason"=>$request_response[0]['reason'],
                                                        "files"=>$request_response[0]['files']);
                    
                    $this->loadContent('director_response',$this->data);
                }
            }  
        }

        //Get the history from specific member
        public function selectMemberHistory(){
            if($this->isLogged()){
                $memberDAO = new MemberDAO();
                $historyDAO = new HistoryDAO();
                $requestDAO = new RequestDAO();
                $fields = array('name,personal_email,professional_email,birthdate,telephone,member_type,score,marital_status');
                
                $filters = array('cpf'=>$_POST['cpf']);
                $members = $memberDAO->retrieve($fields,$filters); //Get the member
                
                $filters = array('member_cpf'=>$_POST['cpf']);
                $history = $historyDAO->retrieve(array(),$filters); //Get the member history

                $filters = array("member_cpf"=>$_POST['cpf'],
                                 "status"=>"opened");
                $requests = $requestDAO->retrieve(array(),$filters); //Get opened requests
                echo json_encode(array($members[0],$history,$requests));
            }
        }

        //Turn off the member
        public function removeMember(){
            if($this->isLogged()){
                if(isset($_POST) && !empty($_POST)){
                    //Save member data 
                    $memberDAO = new MemberDAO();
                    $fields = array("password");
                    $filters = array("cpf"=>$_SESSION['cpf']);
                    $director_password;
                    
                    if(!empty($_POST['password_director'])){
                        $director_password = $_POST['password_director'];
                    }else{
                        echo json_encode(array("success"=>false,"message"=>"Por favor, insira a senha"));
                        return;
                    }

                    $director = $memberDAO->retrieve($fields,$filters)[0];
                    if(password_verify($director_password,$director->getPassword())){
                        //Get the member score
                        $fields = array("score","name");
                        $filters = array("cpf"=>$_POST['member_cpf']);
                        $member = $memberDAO->retrieve($fields,$filters)[0];
                        $memberScore = intval($member->getScore());

                        //Get the admin
                        $filter = array("member_type" => "admin");
                        $admin = $memberDAO->retrieve(array(),$filter)[0];
                        $adminScore = intval($admin->getScore());

                        if($admin->getCPF() == $_POST['member_cpf']){
                            echo json_encode(array("success"=>false,"message"=>"Operação Inválida"));
                            return;
                        }
                        //Update admin score
                        $new_data = array("score"=>$adminScore + $memberScore);
                        $filter = array("cpf" => $admin->getCPF());
                        $memberDAO->update($new_data,$filter);

                        $historyDAO = new HistoryDAO(); //Add the transaction to member history
                        $historyDAO->insert($admin->getCPF(),
                                            "Desligamento de ".$member->getName(),
                                            "gain",
                                            $memberScore);

                        //Remove the member
                        $memberDAO->delete(array("cpf"=>$_POST['member_cpf']));
                        echo json_encode(array("success"=>true,"message"=>""));
                    }else{
                        echo json_encode(array("success"=>false,"message"=>"Senha incorreta!"));
                    }
                }
            }
        }

        //This method saves the path for the profile image file of a member.
        public function savePicture(){
            if(isset($_FILES['profile']) && !empty($_FILES['profile'])){
                if(strpos($_FILES['profile']['type'],"image") > -1){
                    //Generate a simple hash number
                    $startCode = rand(0,32);
                    $middleCode = rand(13,89);
                    $endCode = rand(134,256);

                    //Makes a new filename
                    $imgCode = $startCode.$middleCode.$endCode;
                    $tmpName = "profile".$imgCode;
                    $extension = pathinfo($_FILES['profile']['name'])['extension'];
                   
                    //Makes a final filename
                    $finalName = $tmpName.'.'.$extension;
                    $directoryName = MEDIA_BASE.'profile';

                    //Saves file on server and send the response containing the path.
                    $path = $directoryName.'/'.$finalName;
                    move_uploaded_file($_FILES['profile']['tmp_name'],$path);
                    echo json_encode(array("path"=>ROOT_URL."media/profile/".$finalName));
                }                
            }
        }

        //This method saves the path for the requests files of a member.
        public function saveRequestFiles(){
            if(isset($_FILES['files']) && !empty($_FILES['files'])){
                $paths = array();
                for($i=0;$i<count($_FILES['files']['name']);$i++){
                    //Generate a simple hash number
                    $startCode = rand(0,32);
                    $middleCode = rand(13,89);
                    $endCode = rand(134,256);

                    //Makes a new filename
                    $imgCode = $startCode.$middleCode.$endCode;
                    $tmpName = "request".$imgCode;
                    $extension = pathinfo($_FILES['files']['name'][$i])['extension'];
                   
                    //Makes a final filename
                    $finalName = $tmpName.'.'.$extension;
                    $directoryName = MEDIA_BASE.'requests';

                    //Saves file on server and send the response containing the path.
                    $path = $directoryName.'/'.$finalName;
                    move_uploaded_file($_FILES['files']['tmp_name'][$i],$path);
                    array_push($paths,DOWNLOAD_URL."media/requests/".$finalName);
                }
                return $paths;
            }
        }
    }