<?php
class CSVCreation
{
    var $db_server;
    var $db_name;
    var $db_user;
    var $db_pass;
    var $dbh;
    var $path = 'uploads/';

    function CSVCreation()
    {

        $this->db_server = 'localhost';
        $this->db_name   = 'LeveragedMedia';
        $this->db_user   = 'root';
        $this->db_pass   = 'password';
        $this->connect();

    }

    function connect()
    {
         $this->dbh = @mysql_connect($this->db_server, $this->db_user, $this->db_pass);
         if (!$this->dbh)
         {
                printf("Error: Connection to MySQL server failed.<BR>\n");
                return;
         }
         if (!@mysql_select_db($this->db_name, $this->dbh))
         {
                printf("Error: Selection of MySQL database failed.");
                return;
         }
    }

    function query ($query)
    {
		if(!$this->dbh) die();
		$result = mysql_query($query, $this->dbh) or die("<br>".mysql_error());
        return $result;
    }

	function SelectAll($tablename,$record_start=0,$record_end=50000){

		$query = "select * from $tablename LIMIT $record_start,$record_end";
		$result = $this->query($query);
        return $result;

	}

    function createcsv($tablename){

    	$rs  = $this->SelectAll($tablename);
        $rs1 = $this->SelectAll($tablename);
        if($rs){
            $string ="";
            /// Get the field names
            $fields =  mysql_fetch_assoc($rs1);
            if(!is_array($fields))
              return;
            while(list($key,$val) =each($fields))
                $string .= $key.',';
            $string = substr($string,0,-1)."\015\012";
            /// Get the data
            while($row = mysql_fetch_assoc($rs)) {
                while(list($key,$val) =each($row)){
                  $row[$key] = htmlentities($row[$key], ENT_COMPAT, "UTF-8");
                  $row[$key] = str_replace(',',' ',rtrim($row[$key]));
                  $row[$key] = str_replace("\015\012",' ',$row[$key]);
                }
                $string .= (implode($row,","))."\015\012";
             }

            $fp = fopen($this->path.$tablename.".csv",'w');
            fwrite($fp,$string);
            fclose($fp);
        }

    }

    function createCSVforall(){

       $result = mysql_list_tables($this->db_name);
       while($row = mysql_fetch_array($result)){
           $this->createcsv($row[0]);
       }
    }

}
?>