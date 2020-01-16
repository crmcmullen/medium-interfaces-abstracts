<?php

require_once ('data_access.php');
require_once ('data_interface.php');

class Customers extends Data_Access implements Data_Interface {

    public function __construct() {
        // attempt database connection
        $res = $this->dbConnect();
        
        // if we get anything but a good response ...
        if ($res['response'] != '200') {
            echo "Houston? We have a problem.";
            die;
        }
    }

    public function insertRecord() {
        // Your code goes here.
    }
    public function deleteRecord($varRecordId) {
        // Your code goes here.
    }

    public function getList($varCustomerNumber) {

        $query = "SELECT * FROM classicmodels.customers ";

        if ($varCustomerNumber != 0) {
            $query .= "WHERE customerNumber = " . $varCustomerNumber . " "; 
        }

        $query .= "ORDER BY customerName;";

        $res = $this->getResultSetArray($query);

        return $res;
    }

}