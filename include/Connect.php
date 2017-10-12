<? include dirname(__FILE__)."/Configuration.php"?>
<?php
class db_driver {                     
                     
     var $query_id      = "";
     var $connection_id = "";
     var $query_count   = 0;
     var $record_row    = array();
     var $return_die    = 0;
     var $error         = "";
	 var $record_object = array();	 
	
                  
    /*========================================================================*/
    // Connect to the database                 
    /*========================================================================*/  
                   
    function connect() { 
	global $mysqlhost,$mysqluser,$mysqlpwd,$mysqldb;

	$this->connection_id = mysqli_connect( $mysqlhost ,$mysqluser ,$mysqlpwd, $mysqldb); 
		
        if (!$this->connection_id)
        {
            echo ("ERROR: Failed to connect to database ".$mysqldb);
        }
    }
    
    
    /*========================================================================*/
    // Process a query
    /*========================================================================*/
    
    function query($the_query) {
    	
        $this->query_id = mysqli_query($this->connection_id, $the_query);
      
        if (! $this->query_id )
        {
            $this->fatal_error("mySQL query error: $the_query");
        }
        return $this->query_id;
    }
	
    
    /*========================================================================*/
    // Fetch a row based on the last query
    /*========================================================================*/
    
    function fetch_row($query_id = "") {
    
    	if ($query_id == "")
    	{
    		$query_id = $this->query_id;
    	}
    	
        $this->record_row = mysqli_fetch_array($query_id, MYSQL_ASSOC);
        
        return $this->record_row;
        
    }
	
	function getRow($sql){
		$res=mysqli_query($this->connection_id,$sql);//resourse
		if(!$res){
			echo mysqli_error($this->connection_id);
		return;
		}
		$result=mysqli_fetch_array($res,MYSQL_ASSOC);
		return $result;
	}
	
	
    /*========================================================================*/
    // Fetch a row based on the last query
    /*========================================================================*/
	
	function getAll($sql,$gettype=MYSQL_ASSOC){
		$result = array();
		$this->query_id=mysqli_query($this->connection_id,$sql);
		if (! $this->query_id )
        {
            $this->fatal_error("mySQL query error: $the_query");
        }
		while($row=mysqli_fetch_array($this->query_id,$gettype)){
			$result[]=$row;	
		}
		return $result;
	}

    
    /*========================================================================*/
    // Fetch the number of rows in a result set
    /*========================================================================*/
    
    function get_num_rows() {
        return mysqli_num_rows($this->query_id);
    }
    
    /*========================================================================*/
    // Fetch the last insert id from an sql autoincrement
    /*========================================================================*/
    
    function get_insert_id() {
        return mysqli_insert_id($this->connection_id);
    }  
    
    /*========================================================================*/
    // Return the amount of queries used
    /*========================================================================*/
    
    function get_query_cnt() {
        return $this->query_count;
    }
    
    
    /*========================================================================*/
    // Shut down the database
    /*========================================================================*/
    
    function close_db() { 
        return mysqli_close($this->connection_id);
    }
    
   	
    /*========================================================================*/
    // Basic error handler
    /*========================================================================*/
    
    function fatal_error($the_error) {
    	// Are we simply returning the error?
    	
    	if ($this->return_die == 1)
    	{
    		$this->error = mysqli_error($this->connection_id);
    		return TRUE;
    	}
    }
 }

 $db=new db_driver();
 $db->connect();
 $db->query("set names utf8"); 
?>
