<?php

    class HistoryDAO extends DAO{

        //Insert a new event to member history
        public function insert($cpf,$reason,$action,$value){
            $stmt = $this->PDO->prepare("INSERT INTO `member_history`(`id`, `member_cpf`,`date`,`reason`, 
                                                       `action`, `value`) 
                                 VALUES (:id,:member_cpf,:day,:reason,:action,:value)");
            
            $date = $this->getCurrentDate();
            $stmt->bindValue(":id",null,PDO::PARAM_STR);
            $stmt->bindValue(":member_cpf",$cpf,PDO::PARAM_STR);
            $stmt->bindValue(":day",$date,PDO::PARAM_STR);
            $stmt->bindValue(":reason",$reason,PDO::PARAM_STR);
            $stmt->bindValue(":action",$action,PDO::PARAM_STR);
            $stmt->bindValue(":value",$value,PDO::PARAM_STR);

            $stmt->execute();

        }

        //Update member history data. The query is generated dinamically from the parameters
        public function update($data,$filters){
            $query = "UPDATE member_history SET ";

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

        //Retrieve the member history. The query is generated dinamically from the parameters
        public function retrieve($fields,$filters){

            $query = "SELECT ";

            if(count($fields) == 0){
                $fields = array("*");
            }

            $query .= implode(',',$fields)." FROM member_history";

            if(count($filters) > 0){
                $query .= " WHERE ";
                $aux = array();

                foreach($filters as $key=>$value){
                    $aux[] = $key."="."'$value'";
                }
                
                $query .= implode(" AND ",$aux);
            }
            $result = $this->PDO->query($query);

            $history = array();
            if(!empty($result) && $result->rowCount() > 0){
                foreach($result->fetchAll() as $item){
                    $history[] = array("project_id"=>isset($item['project_id'])?$item['project_id']:null,
                                       "member_cpf"=>isset($item['member_cpf '])?$item['member_cpf']:null,
                                       "reason"=>isset($item['reason'])?$item['reason']:null,
                                       "date"=>isset($item['date'])?$this->convertDate($item['date']):null,
                                       "action"=>isset($item['action'])?$item['action']:null,
                                       "value"=>isset($item['value'])?$item['value']:null);
                }    
            }
            
            return $history;
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