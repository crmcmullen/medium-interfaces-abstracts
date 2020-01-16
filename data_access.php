<?php

abstract class Data_Access {
    
    //--------------------------------------------------------------------------------------------------------------------
    protected function dbConnect() {
		
        $dbHost = 'mysql-localhost';
        $dbUsername = 'classicmodelsUser';
        $dbPassword = 'foobarPassword';
        $dbSchema = 'classicmodels';

        // establish a database connection
		if (!isset($GLOBALS['dbConnection'])) {
			$GLOBALS['dbConnection'] = new mysqli($dbHost, $dbUsername, $dbPassword, $dbSchema);
        }
        
		// if an error occurred, record it
		if (mysqli_connect_errno()) {
			// if an error occurred, raise it.
			$responseArray['response'] = '500';
			$responseArray['message'] = 'MySQL error: ' . mysqli_connect_errno() . ' ' . mysqli_connect_error();
		} else {
			// success
			$responseArray['response'] = '200';
			$responseArray['message'] = 'Database connection successful.';
        }
        
        return $responseArray;

	}

    //--------------------------------------------------------------------------------------------------------------------
	protected function getResultSetArray($varQuery) {

        // attempt the query
        $rsData = $GLOBALS['dbConnection']->query($varQuery);
        
		// if an error occurred, raise it
		if (isset($GLOBALS['dbConnection']->errno) && ($GLOBALS['dbConnection']->errno != 0)) {
			// if an error occurred, raise it.
			$responseArray['response'] = '500';
			$responseArray['message'] = 'Internal server error. MySQL error: ' . $GLOBALS['dbConnection']->errno;
		} else {      
            // success
			$rowCount = $rsData->num_rows;
			
			if ($rowCount != 0) {
				// move result set to an associative array
                $rsArray = $rsData->fetch_all(MYSQLI_ASSOC);
			
				// add array to return
                $responseArray['response'] = '200';
                $responseArray['message'] = 'Success';
				$responseArray['dataArray'] = $rsArray;

				// Free result set
				$rsData->free_result();
			
			} else {
				// no data returned
                $responseArray['response'] = '204';
                $responseArray['message'] = 'Query did not return any results.';
			}
			
		}
		return $responseArray;
	}

}