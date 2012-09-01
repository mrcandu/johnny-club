<?php
class db 
    { 
	
    var $Link_ID  = 0;  // Result of mysql_connect(). 
    var $Query_ID = 0;  // Result of most recent mysql_query(). 
    var $Record   = array();  // current mysql_fetch_array()-result. 
    var $Row;           // current row number. 
    var $LoginError = ""; 

    var $Errno    = 0;  // error state of query... 
    var $Error    = ""; 
	     
//------------------------------------------- 
//    Connects to the database 
//------------------------------------------- 
    function connect() 
        { 
		
        if( 0 == $this->Link_ID ) 
            $this->Link_ID=mysql_connect( $this->Host, $this->User, $this->Password ); 
        if( !$this->Link_ID ) 
            $this->halt( "Link-ID == false, connect failed" ); 
        if( !mysql_query( sprintf( "use %s", $this->Database ), $this->Link_ID ) ) 
            $this->halt( "cannot use database ".$this->Database ); 
        } // end function connect 

//------------------------------------------- 
//    Queries the database 
//------------------------------------------- 
    function query( $Query_String ) 
        { 
        $this->connect(); 
        $this->Query_ID = mysql_query( $Query_String,$this->Link_ID ); 
        $this->Row = 0; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        if( !$this->Query_ID ) 
            $this->halt( "Invalid SQL: ".$Query_String ); 
        return $this->Query_ID; 
        } // end function query 

//------------------------------------------- 
//    If error, halts the program 
//------------------------------------------- 
    function halt( $msg ) 
        { 
        printf( "</td></tr></table><b>Database error:</b> %s<br>n", $msg ); 
        printf( "<b>MySQL Error</b>: %s (%s)<br>n", $this->Errno, $this->Error ); 
        die( "Session halted." ); 
        } // end function halt 

//------------------------------------------- 
//    Retrieves the next record in a recordset 
//------------------------------------------- 
    function nextRecord() 
        { 
        @ $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $this->Row += 1; 
        $this->Errno = mysql_errno(); 
        $this->Error = mysql_error(); 
        $stat = is_array( $this->Record ); 
        if( !$stat ) 
            { 
            @ mysql_free_result( $this->Query_ID ); 
            $this->Query_ID = 0; 
            } 
        return $stat; 
        } // end function nextRecord 

//------------------------------------------- 
//    Retrieves a single record 
//------------------------------------------- 
    function singleRecord() 
        { 
        $this->Record = mysql_fetch_array( $this->Query_ID ); 
        $stat = is_array( $this->Record ); 
        return $stat; 
        } // end function singleRecord 

//------------------------------------------- 
//    Returns the number of rows  in a recordset 
//------------------------------------------- 
    function numRows() 
        { 
        return mysql_num_rows($this->Query_ID);
        } // end function numRows 
		
		// Returns the rows as an array of rows 
// Providing a key_column gives you access to specific rows (e.g. if (isset($result_array[$user_id])) ...) 

	function resultArray() 
		{ 
		$key_column = null;
    	for ($array = array(); $row = mysql_fetch_assoc($this->Query_ID); isset($row[$key_column]) ? $array[$row[$key_column]] = $row : $array[] = $row); 
		if(!empty($array)) {
    	return $array; }
		} 
	
	function resultArrayValues() 
		{ 
    	for ($array = array(); $row = mysql_fetch_row($this->Query_ID); isset($row[0]) ? $array[$row[0]] = $row[1] : $array[] = $row[1]); 
		if(!empty($array)) {
    	return $array; }
		}
		
	function resultArrayArrayValues() 
		{ 
    	for ($array = array(); $row = mysql_fetch_row($this->Query_ID); $array[$row[0]][$row[1]] = $row[2]); 
		if(!empty($array)) {
    	return $array; }
		}
		
	function InsertID()
		{
		return mysql_insert_id();
		}
         
    } // end class Database 
?>