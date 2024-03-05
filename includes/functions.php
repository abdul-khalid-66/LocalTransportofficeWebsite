<?php
include_once "dbConnection.php";


class CrudOperation extends DBConnection{
    function createRecords(){

    }
    function readRecords($table , $columns = '*' , $where = null , $between = null , $join = null , $limit = null, $offset=null, $orderBy = null){

        $query = "SELECT $columns FROM $table";
        if($where != null){
            $query .= " Where  $where";
        }
        if($between != null){
            $query .= " Between  $between";
        }
        if($join != null){
            $query .= " join  $join";
        }       
        
        if ($orderBy != null) {
            $query .= " ORDER BY $orderBy";
        }
        if($limit != null){
            $query .= " limit  $limit";
        }
        if($offset != null){
            $query .= " offset  $offset";
        }
        $result = $this->connection->query($query);

        return ($result) ? $result->fetch_all(MYSQLI_ASSOC) : [];


    }
    function updateRecords(){

    }
    function deleteRecords(){

    }
}

?>


