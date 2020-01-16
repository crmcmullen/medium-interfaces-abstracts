<?php

interface Data_Interface { 
    public function insertRecord();
    public function deleteRecord($varRecordId);
    public function getList($varFilter);
}