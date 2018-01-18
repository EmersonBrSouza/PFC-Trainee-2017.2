<?php

    class RequestDAO extends DAO{

        //Insert a new request in database
        public function insert($cpf,$reason,$status){
            $stmt = $this->PDO->prepare("INSERT INTO `member_request`(`request_id`, `member_cpf`,`status`,`reason`) 
                                 VALUES (:request_id,:member_cpf,:status,:reason)");
            

            $stmt->bindValue(":request_id",null,PDO::PARAM_STR);
            $stmt->bindValue(":member_cpf",$cpf,PDO::PARAM_STR);
            $stmt->bindValue(":status",$status,PDO::PARAM_STR);
            $stmt->bindValue(":reason",$reason,PDO::PARAM_STR);

            $stmt->execute();
            return $this->PDO->lastInsertId();
        }

        //Update the request data in database. The query is generated dinamically from the parameters
        public function update($data,$filters){
            $query = "UPDATE member_request SET ";

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

        //Retrieve a request. The query is generated dinamically from the parameters
        public function retrieve($fields,$filters){

            $query = "SELECT ";

            if(count($fields) == 0){
                $fields = array("*");
            }

            $query .= implode(',',$fields)." FROM member_request";

            if(count($filters) > 0){
                $query .= " WHERE ";
                $aux = array();

                foreach($filters as $key=>$value){
                    $aux[] = $key."="."'$value'";
                }
                
                $query .= implode(" AND ",$aux);
            }

            $result = $this->PDO->query($query);

            $request = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $request[] = array("request_id"=>isset($item['request_id'])?$item['request_id']:null,
                                       "member_cpf"=>isset($item['member_cpf'])?$item['member_cpf']:null,
                                       "reason"=>isset($item['reason'])?$item['reason']:null,
                                       "status"=>isset($item['status'])?$item['status']:null,
                                       "files"=>isset($item['request_id'])?$this->getRequestFiles($item['request_id']):null);
                }
            }
            
            return $request;
        }


        //Delete a request. The query is generated dinamically from the parameters
        public function delete($filters){
            $query = "DELETE FROM member_request ";

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

        //Returns the current date
        private function getCurrentDate(){
            date_default_timezone_set('America/Bahia');
            return date("Y-m-d");
        }

        //Converts the date format
        private function convertDate($date){
            return implode('/',array_reverse(explode('-',$date)));
        }

        //Get the request files of a request
        private function getRequestFiles($request_id){
            $query = "SELECT * FROM request_files WHERE request_id='$request_id'";

            $result = $this->PDO->query($query);

            $files = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $files[] = array("request_id"=>isset($item['request_id'])?$item['request_id']:null,
                                       "path"=>isset($item['filepath'])?$item['filepath']:null);
                }
            }
            return $files;
        }

        //Associate a filepath with request id
        public function associateFile($request_id,$path){
            $stmt = $this->PDO->prepare("INSERT INTO `request_files`(`request_id`, `filepath`) 
                                 VALUES (:request_id,:filepath)");
            
            $stmt->bindValue(":request_id",$request_id,PDO::PARAM_STR);
            $stmt->bindValue(":filepath",$path,PDO::PARAM_STR);
            $stmt->execute();
        }
    }