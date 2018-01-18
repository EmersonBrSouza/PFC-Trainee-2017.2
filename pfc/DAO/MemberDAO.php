<?php

    class MemberDAO extends DAO{

        //Inserts a new member in database
        public function insert($member){
            $stmt = $this->PDO->prepare("INSERT INTO `member`(`name`, `personal_email`, `professional_email`, 
                                                       `rg`, `cpf`, `password`, `birthdate`, `telephone`, `marital_status`, 
                                                       `member_type`, `score`, `path_profile_picture`) 
                                 VALUES (:name,:personal_email,:professional_email,:rg,
                                        :cpf,:password,:birthdate,:telephone,:marital_status,
                                        :member_type,:score,:path_profile_picture)");
            
            $stmt->bindValue(":name",$member->getName(),PDO::PARAM_STR);
            $stmt->bindValue(":personal_email",$member->getPersonalEmail(),PDO::PARAM_STR);
            $stmt->bindValue(":professional_email",$member->getProfessionalEmail(),PDO::PARAM_STR);
            $stmt->bindValue(":rg",$member->getRG(),PDO::PARAM_STR);
            $stmt->bindValue(":cpf",$member->getCPF(),PDO::PARAM_STR);
            $stmt->bindValue(":password",$member->getPassword(),PDO::PARAM_STR);
            $stmt->bindValue(":birthdate",$member->getBirthdate(),PDO::PARAM_STR);
            $stmt->bindValue(":telephone",$member->getTelephone(),PDO::PARAM_STR);
            $stmt->bindValue(":marital_status",$member->getMaritalStatus(),PDO::PARAM_STR);
            $stmt->bindValue(":member_type",$member->getMemberType(),PDO::PARAM_STR);
            $stmt->bindValue(":score",$member->getScore(),PDO::PARAM_STR);
            $stmt->bindValue(":path_profile_picture",$member->getProfilePicture(),PDO::PARAM_STR);
            
            $stmt->execute();

        }

        //Update the member data in database. The query is generated dinamically from the parameters
        public function update($data,$filters){
            $query = "UPDATE member SET ";

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

        //Retrieve a member from database. The query is generated dinamically from the parameters
        public function retrieve($fields,$filters){

            $query = "SELECT ";

            if(count($fields) == 0){
                $fields = array("*");
            }

            $query .= implode(',',$fields)." FROM member";

            if(count($filters) > 0){
                $query .= " WHERE ";
                $aux = array();

                foreach($filters as $key=>$value){
                    $aux[] = $key."="."'$value'";
                }
                
                $query .= implode(" AND ",$aux);
            }
            $result = $this->PDO->query($query);
            
            $members = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $members[] = new Member(isset($item['name'])?$item['name']:null,
                                            isset($item['personal_email'])?$item['personal_email']:null,
                                            isset($item['professional_email'])?$item['professional_email']:null,
                                            isset($item['rg'])?$item['rg']:null,
                                            isset($item['cpf'])?$item['cpf']:null,
                                            isset($item['password'])?$item['password']:null,
                                            isset($item['birthdate'])?$item['birthdate']:null,
                                            isset($item['telephone'])?$item['telephone']:null,
                                            isset($item['marital_status'])?$item['marital_status']:null,
                                            isset($item['member_type'])?$item['member_type']:null,
                                            isset($item['score'])?$item['score']:null,
                                            isset($item['path_profile_picture'])?$item['path_profile_picture']:null);
                }    
            }
            
            return $members;
        }

        //Search a member in database using LIKE. The query is generated dinamically from the parameters
        public function searchLike($fields,$filters){
            $query = "SELECT ";

            if(count($fields) == 0){
                $fields = array("*");
            }

            $query .= implode(',',$fields)." FROM member";

            if(count($filters) > 0){
                $query .= " WHERE ";
                $aux = array();

                foreach($filters as $key=>$value){
                    $aux[] = $key." LIKE "."'%$value%'";
                }
                
                $query .= implode(" AND ",$aux);
            }
            
            $result = $this->PDO->query($query);

            $members = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $members[] = new Member(isset($item['name'])?$item['name']:null,
                                            isset($item['personal_email'])?$item['personal_email']:null,
                                            isset($item['professional_email'])?$item['professional_email']:null,
                                            isset($item['rg'])?$item['rg']:null,
                                            isset($item['cpf'])?$item['cpf']:null,
                                            isset($item['password'])?$item['password']:null,
                                            isset($item['birthdate'])?$item['birthdate']:null,
                                            isset($item['telephone'])?$item['telephone']:null,
                                            isset($item['marital_status'])?$item['marital_status']:null,
                                            isset($item['member_type'])?$item['member_type']:null,
                                            isset($item['score'])?$item['score']:null,
                                            isset($item['path_profile_picture'])?$item['path_profile_picture']:null);
                }    
            }
            
            return $members;
        }

        //Delete a member from database. The query is generated dinamically from the parameters
        public function delete($filters){
            $query = "DELETE FROM member ";

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
    }