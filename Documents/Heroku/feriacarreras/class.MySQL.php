<?php
/**
* MySQL Database Connection Class
* @access public
*/
class MySQL {
    /**
    * MySQL server hostname
    * @access private
    * @var string
    */
    var $host;

    /**
    * MySQL username
    * @access private
    * @var string
    */
    var $dbUser;

    /**
    * MySQL user's password
    * @access private
    * @var string
    */
    var $dbPass;

    /**
    * Name of database to use
    * @access private
    * @var string
    */
    var $dbName;

    /**
    * MySQL Resource link identifier stored here
    * @access private
    * @var string
    */
    var $dbConn;

    /**
    * Stores error messages for connection errors
    * @access private
    * @var string
    */
    var $connectError;
	
	/**
	* Stores the error messages
	* @access private
	* @var string
	*/
	var $errorMsg;

    /**
    * MySQL constructor
	*
    * @param string host (MySQL server hostname)
    * @param string dbUser (MySQL User Name)
    * @param string dbPass (MySQL User Password)
    * @param string dbName (Database to select)
    * @access public
    */
    function MySQL($host,$dbUser,$dbPass,$dbName) {
        $this->host 	= $host;
        $this->dbUser 	= $dbUser;
        $this->dbPass	= $dbPass;
        $this->dbName	= $dbName;
        $this->connect();
    }

    /**
    * Establishes connection to MySQL and selects a database
	*
    * @return void
    * @access private
    */
    function connect() {
        // Make connection to MySQL server
        if (!$this->dbConn = @mysql_connect($this->host, $this->dbUser, $this->dbPass)) {
            $this->errorMsg = 'Could not connect to server';
            $this->connectError = true;
        // Select database
        } else if ( !@mysql_select_db($this->dbName,$this->dbConn) ) {
            $this->errorMsg = 'Could not select database';
            $this->connectError = true;
        }
    }

    /**
    * Checks for MySQL errors
	*
    * @return boolean
    * @access public
    */
    function isError() {
        if ( $this->connectError ) { return true; }
        $this->errorMsg = mysql_error($this->dbConn);
        
		if ( empty($this->errorMsg) ) {
            return false;
		} else {
            return true;
		}
    }
	
	/**
	* Returns the error message if there is one set
	*
	* @return string
	* @access public
	*/
	function getErrorMsg() {
		return '<p style="color:red">' . $this->errorMsg . '</p>';
	}

    /**
    * Returns an instance of MySQLResult to fetch rows with
	*
    * @param $sql string (the database query to run)
    * @return MySQLResult
    * @access public
    */
    function  query($sql) {
        if (!$this->query = @mysql_query($sql,$this->dbConn)) {
            $this->errorMsg = 'Query failed: ' . mysql_error($this->dbConn) . ' SQL: ' . $sql;
		}
        return $this->query;
    }
	
    function MySQLResult(& $mysql,$query) {
        $this->mysql=& $mysql;
        $this->query=$query;
    }

    function fetchRow($query) {
        if ( $row = @mysql_fetch_array($query,MYSQL_ASSOC) ) {
            return $row;
        } else if ( $this->numRows($query) > 0 ) {
            @mysql_data_seek($query,0);
            return false;
        } else {
            return false;
        }
    }
     /**
    * Returns an result from the database
	*
    * @param $sql string (the database query to run)
    * @return MySQLResult
    * @access public
    */
    function select($sql) {
        if (!$query = @mysql_query($sql,$this->dbConn)) {
			$this->errorMsg = 'Query failed: ' . mysql_error($this->dbConn) . ' SQL: ' . $sql;return false;	}
		if(@mysql_num_rows($query)>0){
		$resultado=array();
        while( $row = @mysql_fetch_array($query,MYSQL_ASSOC) ) {
           array_push($resultado,$row);
		   }
		 }else{
		 	return false;
		 }
		 return $resultado;
    }
    /**
    * Returns the number of rows selected
	*
    * @return int
    * @access public
    */
    function numRows($query) {

        return @mysql_num_rows($query);
    }

 	/**
    * Returns the number of fields selected
	*
    * @return int
    * @access public
    */
    function numFields($query) {
        return @mysql_num_fields($query);
    }
	
    /**
    * Fetches a row from the result
	*
    * @return array
    * @access public
    */
    function fetchField($query,$i) {
		if(mysql_field_flags($query,$i)=="primary_key"){
			$row = @mysql_field_name($query,$i);
			$rs=array($row,1);
			return $rs;
		}
        if ( $row = @mysql_field_name($query,$i) ) {
			$rs=array($row,0);
			return $rs;
        } else if ( $this->numFields($query) > 0 ) {
            @mysql_data_seek($query,0);
            return false;
        } else {
            return false;
        }
    }
	
    /**
    * Returns the ID of the last row inserted
	*
    * @return int
    * @access public
    */
    function insertID() {
        return @mysql_insert_id($this->dbConn);
    }
	
	
	function insert($strSQL,$getLastID = true, &$error_sql = ''){
	// Funcion para realizar consultas insert, si la consulta pasada como parametro no es
	// una consulta insert se termina la ejecucion y se informa el error.
	// Si la consulta se realiza con exito y el parametro $getLastId = false, se retorna
	// true en caso de haber podido realizar la insersion y false en caso contrario.
	// Si la consulta se realiza con exito y el parametro $getLastId = true, se retorna el
	// id de la ultima insersion.
	
		if(strtolower(substr(trim($strSQL),0,6)) != "insert")
			die ("An error has happened in the insert function in MySQL class. "
	 		   ."A INSERT query was expected <br/> The query was $strSQL" );

		$this->connect();
		$resource = @mysql_query($strSQL);
		if(!$resource){
			$mysql_error = mysql_error();
			$error_sql = mysql_errno(); // devuelve el codigo de error dado por el motor mysql
			//dump("entro a false del insert!!!!!");
			/*
	 		die ("An error has happened in the insert function in MySQL class. "
	 		   ."$mysql_error <br/> The query was $strSQL" );
			   */
			return false;
		}
		$this->rows = NULL;
		$this->lastOperation = 'insert';
		$this->numOfRows = 0;
		$this->actualRow = 0;
		
		if($getLastID == false){

			return true;
		}else{
			$lastID = mysql_insert_id();
			return $lastID;
		}
	}
	
	function  begin() {
		return @mysql_query("BEGIN",$this->dbConn);
  }
	
	function  rollback() {
		return @mysql_query("ROLLBACK",$this->dbConn);
  }
	
	function  commit() {
		return @mysql_query("COMMIT",$this->dbConn);
  }
	
	
	function update($strSQL, &$error_sql = ''){
	// Funcion para realizar consultas update, si la consulta pasada como parametro no es
	// una consulta update se termina la ejecucion y se informa el error.
	// Si la consulta se realiza con exito esta funcion retorna el numero de filas afectadas
	// por esta actualizacion (solo el numero de filas realmente actualizadas, y no aquellas que
	// cumplan con la clausula WHERE y posean el mismo valor que el valor a actualizar)
		
		if(strtolower(substr(trim($strSQL),0,6)) != "update")
			die ("An error has happened in the update function in MySQL class. "
	 		   ."A UPDATE query was expected <br/> The query was $strSQL" );
		
		$this->connect();
		$resource = @mysql_query($strSQL);
		if(!$resource){
			$mysql_error = mysql_error();
			$error_sql = mysql_errno(); // devuelve el codigo de error dado por el motor mysql
			return false;  
			//$this->close();
	 		//die ("An error has happened in the update function in MySQL class. "
	 		//   ."$mysql_error <br/> The query was $strSQL" );
		}
		$affectedRows = mysql_affected_rows();
		$this->rows = NULL;
		$this->lastOperation = 'update';
		$this->numOfRows = 0;
		$this->actualRow = 0;
		return $affectedRows;
	}


	function delete($strSQL, &$error_sql = ''){
	// Funcion para realizar consultas delete, si la consulta pasada como parametro no es
	// una consulta delete se termina la ejecucion y se informa el error.
	// Si la consulta se realiza con exito esta funcion retorna el numero de filas eliminadas
		
		if(strtolower(substr(trim($strSQL),0,6)) != "delete")
			die ("An error has happened in the delete function in MySQL class. "
	 		   ."A DELETE query was expected <br/> The query was $strSQL" );

		$this->connect();
		$resource = @mysql_query($strSQL);
		if(!$resource){
			$mysql_error = mysql_error();
			$error_sql = mysql_errno(); // devuelve el codigo de error dado por el motor mysql
			return false;
	 		//die ("An error has happened in the delete function in MySQL class. "
	 		//   ."$mysql_error <br/> The query was $strSQL" );
		}
		$affectedRows = mysql_affected_rows();
		$this->rows = NULL;
		$this->lastOperation = 'delete';
		$this->numOfRows = 0;
		$this->actualRow = 0;
		return $affectedRows;
	}
	
    
}
?>