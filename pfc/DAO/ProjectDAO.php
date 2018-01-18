<?php
    class ProjectDAO extends DAO{
        
        //Insert a new project in database
        public function insert($project){
            $stmt = $this->PDO->prepare("INSERT INTO `project`(`project_id`, `title`, `client_name`, 
                                                       `payment_method`, `duration`, `price`,`status`) 
                                 VALUES (:project_id,:title,:client_name,:payment_method,
                                        :duration,:price,:status)");
            
            $stmt->bindValue(":project_id",null);
            $stmt->bindValue(":title",$project->getTitle(),PDO::PARAM_STR);
            $stmt->bindValue(":client_name",$project->getClientName(),PDO::PARAM_STR);
            $stmt->bindValue(":payment_method",$project->getPaymentMethod(),PDO::PARAM_STR);
            $stmt->bindValue(":duration",$project->getDuration(),PDO::PARAM_STR);
            $stmt->bindValue(":price",$project->getPrice());
            $stmt->bindValue(":status","opened");
            
            $stmt->execute();
            return $this->PDO->lastInsertId();

        }

        //Update the project data in database. The query is generated dinamically from the parameters
        public function update($data,$filters){
            $query = "UPDATE project SET ";

            foreach($data as $key=>$value){
                $query .= $key.'='."'$value',";
            }

            $query = substr($query, 0, -1);
            
            if(count($filters) > 0){
                $query .= " WHERE ";
                $aux = array();

                foreach($filters as $key=>$value){
                    $aux[] = $key." = "."'$value'";
                }

                $query .= implode(" AND ",$aux);
            }
            
            
            $this->PDO->query($query);
        }

        //Retrieve a project from database. The query is generated dinamically from the parameters
        public function retrieve($fields,$filters){
            $query = "SELECT ";

            if(count($fields) == 0){
                $fields = array("*");
            }

            $query .= implode(',',$fields)." FROM project";

            if(count($filters) > 0){
                $query .= " WHERE ";
                $aux = array();

                foreach($filters as $key=>$value){
                    $aux[] = $key."="."'$value'";
                }
                
                $query .= implode(" AND ",$aux);
            }
            $result = $this->PDO->query($query);
            
            $projects = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $projects[] = new Project(isset($item['project_id'])?$item['project_id']:null,
                                            isset($item['title'])?$item['title']:null,
                                            isset($item['client_name'])?$item['client_name']:null,
                                            isset($item['payment_method'])?$item['payment_method']:null,
                                            isset($item['duration'])?$item['duration']:null,
                                            isset($item['price'])?$item['price']:null,
                                            isset($item['status'])?$item['status']:null);
                }    
            }
            
            return $projects;
        }

        //Associates a member to project
        public function associateMember($project_id,$member_cpf,$role){
            $stmt = $this->PDO->prepare("INSERT INTO `members_in_project`(`project_id`, `member_cpf`,`role`) 
                                 VALUES (:project_id,:member_cpf,:role)");
            
            $stmt->bindValue(":project_id",$project_id);
            $stmt->bindValue(":member_cpf",$member_cpf,PDO::PARAM_STR);
            $stmt->bindValue(":role",$role,PDO::PARAM_STR);
            $stmt->execute();
        }

        //Retrieve all associated members of a project
        public function getAssociatedMembers($project_id){
            $query = "SELECT * FROM `members_in_project` INNER JOIN `member` ON `members_in_project`.`member_cpf` = `member`.`cpf` WHERE `project_id` = $project_id";
            $result = $this->PDO->query($query);
            $members = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $role;
                    if(isset($item['role'])){
                        if($item['role'] == "vendor"){
                            $role = "Vendedor";
                        }else{
                            $role = "Membro";
                        }
                    }
                    $members[] = array(new Member(isset($item['name'])?$item['name']:null,
                                            isset($item['personal_email'])?$item['personal_email']:null,
                                            isset($item['professional_email'])?$item['professional_email']:null,
                                            isset($item['rg'])?$item['rg']:null,
                                            isset($item['cpf'])?$item['cpf']:null,
                                            null, //Password null
                                            isset($item['birthdate'])?$item['birthdate']:null,
                                            isset($item['telephone'])?$item['telephone']:null,
                                            isset($item['marital_status'])?$item['marital_status']:null,
                                            isset($item['member_type'])?$item['member_type']:null,
                                            isset($item['score'])?$item['score']:null,
                                            isset($item['path_profile_picture'])?$item['path_profile_picture']:null),
                                            
                                        isset($item['role'])?$role:null);
                }    
            }
            
            return $members;
        }

        //Removes a member from a project
        public function disassociateMember($filters){
            $query = "DELETE FROM members_in_project ";

            if(count($filters) > 0){
                $aux = array();
                $query .= "WHERE ";

                foreach($filters as $key=>$value){
                    $aux[] = $key." = "."'$value'";
                }

                $query .= implode(" AND ",$aux);
            }
            $this->PDO->query($query);
        }

        //Save the payment data
        public function savePayment($project_id,$value,$receptor_name){
            $stmt = $this->PDO->prepare("INSERT INTO `payment_history`(`payment_id`,`project_id`, `date`, `value`, 
                                                       `receptor_name`) 
                                 VALUES (:payment_id,:project_id,:day,:value,
                                        :receptor_name)");
            
            $date = $this->getCurrentDate();
            $stmt->bindValue(":payment_id",null);
            $stmt->bindValue(":project_id",$project_id,PDO::PARAM_STR);
            $stmt->bindValue(":day",$date,PDO::PARAM_STR);
            $stmt->bindValue(":value",$value);
            $stmt->bindValue(":receptor_name",$receptor_name,PDO::PARAM_STR);
            
            $stmt->execute();
        }

        //Get the payment history
        public function getPaymentHistory($project_id){
            $query = "SELECT * FROM `payment_history` WHERE `project_id` = $project_id";
            $result = $this->PDO->query($query);
            $payments = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $payments[] = array("date"=>isset($item['date'])?$this->convertDate($item['date']):null,
                                        "value"=>isset($item['value'])?number_format($item['value'],2,'.',''):null,
                                        "project_id"=>isset($item['project_id'])?$item['project_id']:null,
                                        "payment_id"=>isset($item['payment_id'])?$item['payment_id']:null,
                                        "receptor"=>isset($item['receptor_name'])?$item['receptor_name']:null);
                }    
            }
            
            return $payments;
        }

        //Returns the current date
        private function getCurrentDate(){
            date_default_timezone_set('America/Bahia');
            return date("Y-m-d");
        }
        
        //Converts the date format
        private function convertDate($date){
            return implode('/',array_reverse(explode('-',$date)));
        }
    }