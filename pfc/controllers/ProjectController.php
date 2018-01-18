<?php

    class ProjectController extends MainController{
        
        //Call the index page
        public function index(){
            if($this->isAdmin()){
                $this->loadContent('project_index',array());
            }
        }

        //Create project
        public function create(){
            if($this->isAdmin()){
                if(isset($_POST) && !empty($_POST)){
                    $projectDAO = new ProjectDAO();

                    $project = new Project(null,
                                           $_POST['project_title'],
                                           $_POST['client_name'],
                                           $_POST['payment_method'],
                                           $_POST['project_duration'],
                                           $_POST['price'],
                                           "opened");
                                
                    $project_id = $projectDAO->insert($project); //Insert the project in database
                                        
                    $this->redirect('project/update/'.$project_id);
                }else{
                    $this->loadContent('project_create',array());
                }
            }
        }

        //Update project data
        public function update($project_id){
            if($this->isAdmin()){
                $projectDAO = new ProjectDAO();
                
                if(count($project_id) > 0){ //List a specific project
                    if(isset($_POST) && !empty($_POST)){ //Receive form data and update project data
                        $fields = array("title"=>$_POST['project_title'],
                                        "client_name"=>$_POST['client_name'],
                                        "payment_method"=>$_POST['payment_method'],
                                        "duration"=>$_POST['project_duration'],
                                        "price"=>$_POST['price']);

                        $filters = array("project_id"=>$project_id[0]);
                        $projectDAO->update($fields,$filters);
                        $this->redirect('project');
                    }else{ //Loads the project data to view
                        $fields = array();
                        $filters = array("project_id"=>$project_id[0]);
                        
                        if(!$this->verifyExistence($fields,$filters)){
                            $this->redirect('project/update');
                            return false;
                        }
                        $projectData = $projectDAO->retrieve($fields,$filters)[0];
                        $payments = $projectDAO->getPaymentHistory($project_id[0]);
                        $debit = $this->calculateDebit($payments,$projectData->getPrice());

                        $this->data['project'] = $projectData;
                        $this->data['payments'] = $payments;
                        $this->data['debit'] = number_format($debit,2,'.','');
                        $this->data['team'] = $projectDAO->getAssociatedMembers($project_id[0]);
                        
                        if($projectData->getStatus() == "closed"){
                            $this->loadContent('project_view',$this->data);
                        }else{
                            $this->loadContent('project_update',$this->data);
                        }
                    }
                }else{ //List all projects
                    $this->data['projects'] = $projectDAO->retrieve(array(),array()); //Get all projects
                    $this->loadContent('project_list',$this->data);
                }
            }
        }

        //Search a member
        public function searchMember(){
            if($this->isAdmin()){
                $memberDAO = new MemberDAO();
                $fields = array("name","personal_email","cpf","member_type","score","path_profile_picture");
                $members = $memberDAO->searchLike($fields,array("name"=>$_POST['filter']));

                echo json_encode($members);
            }
        }

        //Put a member in project
        public function associateMember(){
            if($this->isAdmin()){
                $projectDAO = new ProjectDAO();
                
                //Verify if exists vendor in project
                if(strcmp($_POST['role'],"vendor")==0 || strcmp($_POST['role'],"Vendedor") == 0){
                    if($this->existsVendor($_POST['project_id'])){
                        echo json_encode(array("success"=>false,"cause"=>"Já existe um vendedor no projeto"));
                        return;
                    }
                }

                $projectDAO->associateMember($_POST['project_id'],$_POST['member_id'],$_POST['role']);
                
                $memberDAO = new MemberDAO();
                $fields = array("name","cpf");
                $member = $memberDAO->retrieve($fields,array("cpf"=>$_POST['member_id']));
                echo json_encode(array("success"=>true,"data"=>$member));
            }
        }

        //Verify the existence of vendor in project.
        private function existsVendor($project_id){
            $projectDAO = new ProjectDAO();
            $members = $projectDAO->getAssociatedMembers($project_id);
            foreach($members as $member){
                if($member[1] == "vendor" || $member[1] == "Vendedor"){
                    return true;
                }
            }
            return false;
        }

        //Removes a member from project
        public function disassociateMember(){
            if($this->isAdmin()){
                $projectDAO = new ProjectDAO();

                $role = "";

                if($_POST['role'] == "Vendedor"){
                    $role = "vendor";
                }else{
                    $role = "member";
                }

                $filters = array("project_id"=>$_POST['project_id'],
                                 "member_cpf"=>$_POST['member_id'],
                                 "role"=>$role);
                $projectDAO->disassociateMember($filters);
                echo json_encode(true);
            }
        }

        //Verify if project exists
        public function verifyExistence($fields,$filters){
            $projectDAO = new ProjectDAO();
            if(count($projectDAO->retrieve($fields,$filters)) > 0){
                return true;
            }
            return false;
        }
        
        //Save the payment information
        public function paymentCheckout(){
            if($this->isAdmin()){
                $projectDAO = new ProjectDAO();
                $memberDAO = new MemberDAO();
                $receptor = $memberDAO->retrieve(array("name"),array("cpf"=>$_SESSION['cpf']))[0];
                $projectDAO->savePayment($_POST['project_id'],$_POST['value'],$receptor->getName());
                
                $filters = array("project_id"=>$_POST['project_id']);
                $projectData = $projectDAO->retrieve(array(),$filters)[0];
                $payments = $projectDAO->getPaymentHistory($_POST['project_id']);
                $debit = $this->calculateDebit($payments,$projectData->getPrice());

                $debit = number_format($debit,2,'.','');
                echo json_encode(array($debit,$projectDAO->getPaymentHistory($_POST['project_id'])));
            }
        }

        //Calculate the debit from project
        private function calculateDebit($payments,$project_price){
            $paymentSum = 0;

            foreach($payments as $payment){
                $paymentSum += doubleval($payment["value"]);
            }
            
            return doubleval($project_price) - doubleval($paymentSum);
        }

        //Turn a project finished
        public function finish(){
            if($this->isAdmin()){
                $projectDAO = new ProjectDAO();
                $memberDAO = new MemberDAO();

                $filters = array("project_id"=>$_POST['project_id']);
                $projectData = $projectDAO->retrieve(array(),$filters)[0];
                $payments = $projectDAO->getPaymentHistory($_POST['project_id']);
                $debit = $this->calculateDebit($payments,$projectData->getPrice());

                $members_in_project = $projectDAO->getAssociatedMembers($_POST['project_id']);
                
                $director = $memberDAO->retrieve(array('password'),array("cpf"=>$_SESSION['cpf']))[0];


                if(!password_verify($_POST['password'],$director->getPassword())){
                echo json_encode(array("success"=>false,"cause"=>"Senha incorreta"));
                    return; 
                }

                if($debit != 0){
                    echo json_encode(array("success"=>false,"cause"=>"O valor do débito deve ser 0."));
                    return;
                }

                if(count($members_in_project) == 0){
                    echo json_encode(array("success"=>false,"cause"=>"O projeto deve ter ao menos um membro"));
                    return;
                }

                $this->distributePoints($_POST['project_id']);
                $projectDAO->update(array("status"=>"closed"),array("project_id"=>$_POST['project_id']));
                echo json_encode(array("success"=>true));
            }

        }

        //Distribute points from project to members when the debit is equal to 0
        private function distributePoints($project_id){
            $memberDAO = new MemberDAO();
            $projectDAO = new ProjectDAO();
            
            $filter_project = array("project_id"=>$_POST['project_id']);
            $project = $projectDAO->retrieve(array("title,price"),$filter_project)[0];
            $projectPrice = $project->getPrice();
            $members_in_project = $projectDAO->getAssociatedMembers($project_id);
            
            $filter_director = array("member_type"=>"director"); //Get all directors
            $directors = $memberDAO->retrieve(array(),$filter_director);

            $company_amount = doubleval($projectPrice)*0.8; // 80% to company
            $team_amount = doubleval($projectPrice)*0.2; //20% to team

            $directors_bonus_amount = 0;
            $company_final_amount = 0;
            $director_final_bonus = 0;
            
            if(count($directors) == 0){
                $company_final_amount = doubleval($company_amount); //100% to company
            }else{
                $directors_bonus_amount = doubleval($company_amount)*0.1875; //18.75% to directors
                $company_final_amount = doubleval($company_amount)*0.8125; //81.25% to company

                $director_final_bonus = doubleval($directors_bonus_amount)/count($directors); //Divides the amount to directors
            }


            $vendor_bonus = 0;
            $members_amount = 0;

            if($this->existsVendor($_POST['project_id'])){
                $vendor_bonus = doubleval($team_amount)*0.1; //10% to vendor;
                $members_amount = doubleval($team_amount)*0.9; //90% to team;
            }else{
                $members_amount = doubleval($team_amount); //100% to team;
            }

            $member_final_amount = doubleval($members_amount)/$this->countMembers($members_in_project);

            $this->distributeCompany($company_final_amount,$project->getTitle());
            $this->distributeDirectors($directors,$director_final_bonus,$project->getTitle());
            $this->distributeMembers($vendor_bonus,$member_final_amount,$members_in_project,$project->getTitle());
        }

        //Count the members in project without includes the vendor
        private function countMembers($members){
            $count = count($members);
            foreach($members as $member){
                if($member[1] == "vendor" || $member[1] == "Vendedor"){
                    $count -= 1;
                }
            }
            
            return $count;
        }

        //Distributes the company score
        private function distributeCompany($amount,$project_title){
            $memberDAO = new MemberDAO();
            $historyDAO = new HistoryDAO();

            $company = $memberDAO->retrieve(array("cpf,score"),array("member_type"=>"admin"))[0];
            $newScore = $company->getScore() + $amount;
            $memberDAO->update(array("score"=>$newScore),array("member_type"=>"admin"));
            $historyDAO->insert($company->getCPF(),"Projeto: ".$project_title,"gain",$amount);
        }

        //Distributes the directors score
        private function distributeDirectors($directors,$amount,$project_title){
            $memberDAO = new MemberDAO();
            $historyDAO = new HistoryDAO();

            foreach($directors as $member){
                $director = $memberDAO->retrieve(array("cpf,score"),array("cpf"=>$member->getCPF()))[0];
                $newScore = $director->getScore() + $amount;
                $personal_amount = $amount;
                
                if($newScore > 250){
                    $excess = $newScore - 250;
                    $newScore = 250;
                    $personal_amount = $personal_amount - $excess;
                    $reason = $project_title.' (Pontuação excedente)';
                    $this->distributeCompany($excess,$reason);
                }

                $memberDAO->update(array("score"=>$newScore),array("cpf"=>$director->getCPF()));
                $historyDAO->insert($director->getCPF(),"(Bônus CONDIR) Projeto: ".$project_title,"gain",$personal_amount);
            }
        }

        //Distributes the member score
        private function distributeMembers($vendor_amount,$member_amount,$members,$project_title){
            $memberDAO = new MemberDAO();
            $historyDAO = new HistoryDAO();

            //FALTA VERIFICAR SE O SCORE É MAIOR QUE 250
            foreach($members as $current){
                $newScore;
                if($current[1] == "vendor" || $current[1] == "Vendedor"){ //Vendor Bonus
                    $member = $memberDAO->retrieve(array("cpf,score"),array("cpf"=>$current[0]->getCPF()))[0];
                    $newScore = $member->getScore() + $vendor_amount;
                    $personal_amount = $vendor_amount;
                    
                    if($newScore > 250){
                        $excess = $newScore - 250;
                        $newScore = 250;
                        $personal_amount = $personal_amount - $excess;
                        $reason = $project_title.' (Pontuação excedente)';
                        $this->distributeCompany($excess,$reason);
                    }
                    
                    $memberDAO->update(array("score"=>$newScore),array("cpf"=>$current[0]->getCPF()));
                    $historyDAO->insert($current[0]->getCPF(),"(Bônus de vendedor) Projeto: ".$project_title,"gain",$personal_amount);
                }else{
                    $member = $memberDAO->retrieve(array("cpf,score"),array("cpf"=>$current[0]->getCPF()))[0];
                    $newScore = $member->getScore() + $member_amount;
                    $personal_amount = $member_amount;
                    
                    if($newScore > 250){
                        $excess = $newScore - 250;
                        $personal_amount = $personal_amount - $excess;
                        $newScore = 250;
                        $reason = $project_title.' (Pontuação excedente)';
                        $this->distributeCompany($excess,$reason);
                    }

                    $memberDAO->update(array("score"=>$newScore),array("cpf"=>$current[0]->getCPF()));
                    $historyDAO->insert($current[0]->getCPF(),"Projeto: ".$project_title,"gain",$personal_amount);
                }
                
            }
        }
    }