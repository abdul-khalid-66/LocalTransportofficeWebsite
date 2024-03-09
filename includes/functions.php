<?php
include_once "dbConnection.php";


class CrudOperation extends DBConnection{
    
    public function createRecords($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";

        print_r($columns);

        

        echo $query = "INSERT INTO $table ($columns) VALUES ($values)";
        
        $result = $this->connection->query($query);

        return $result ? true : false;
    }


    


    function readRecords($table , $columns = '*' , $where = null , $between = null , $join = null , $limit = null, $offset=null, $orderBy = null){
        if($this->tableExist($table)){

        
            $query = "SELECT $columns FROM $table";

            if($join != null){
                $query .= " $join ";
            }  
            if($where != null){
                $query .= " Where  $where";
            }
            if($between != null){
                $query .= " Between  $between";
            }
            if ($orderBy != null) {
                $query .= " ORDER BY $orderBy";
            }
            
            if ($limit != null) {
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $limit;
                $query .= " LIMIT $start, $limit";  
            }
            
            if($offset != null){
                $query .= " offset  $offset";
            }
            
            $result = $this->connection->query($query);

            return ($result) ? $result->fetch_all(MYSQLI_ASSOC) : [];

        }


    }

    function pagination($table , $where = null , $join = null , $limit = null){
    if($this->tableExist($table)){


        if($limit != null){

            $query = "SELECT Count(*) FROM $table";

                if($join != null){
                    $query .= " $join ";
                }  
                if($where != null){
                    $query .= " Where  $where";
                }
                
                $result = $this->connection->query($query);
                
                $totalRecords = $result->fetch_array();                
                $totalRecords = $totalRecords[0];
                $totalPages = ceil($totalRecords / $limit);

                $url = basename($_SERVER['PHP_SELF']);
                
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $output ='<nav aria-label="...">
                    <ul class="pagination">';
                        $output .= '<li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>';
                                if($totalRecords > $limit){
                                    for($i = 1; $i <= $totalPages; $i++){
                                        if($i == $page){
                                            $cls = " active ";
                                        }else{
                                            $cls ="";
                                        }
                                        $output .= '<li class="page-item '.$cls.'" aria-current="page">
                                                        <a  class="page-link" href=" '.$url .'?page='.$i.'">'. $i .'</a>
                                                    </li>';
                                    }
                            };
                       
                        
                        $output .= '<li class="page-item">
                                <a class="page-link" href="#">Next</a>
                                </li>';
                    $output .= '</ul>
                </nav>';

                return $output;
                
            }
                
        }
    }

    function updateRecords(){

    }
    function deleteRecords(){

    }


    function tableExist($table) {
        $query = "SHOW TABLES LIKE '$table'";
        $result = $this->connection->query($query);
        return ($result && $result->num_rows > 0);
    }
}

?>


