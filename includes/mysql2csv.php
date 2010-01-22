<?php
/*********************************************************************
 *  Author:     Andris Causs
 *  Email:      cypher[at]inbox[dot]lv
 *  Date:       September 26, 2006
 *  Purpose:    Export MySQL query into CSV file in
 *                  "fieldname";"fieldname";"fieldname"
 *                  "fieldcontent";"fieldcontent";"fieldcontent"
 *              form
 *
 *  You are free to use and modify the code. Just do not copy it and post
 *  somewhere as your own.
 *  Therefore I reserve all rights to this code in modified or unmodified form.
 *  
 *
 *  Class form:
 *    SQL2CSV(array params, string query [, bool print_captions = true]);
 *
 *  Basic usage:
 *  -- create new .php file containing the following text (ignore -- lines):
 *  -- let's name it 'dump_data.php' in this example
 *
 *  -- Require this file from the 'dump' file
 *  require_once 'class.sql2csv.php';
 *
 *  -- Change parameters to match your settings
 *  $params = array(
 *      'host'      => 'localhost',
 *      'user'      => 'root',
 *      'password'  => 'password',
 *      'database'  => 'LeveragedMedia'
 *  );
 *
 *  -- Define your SQL query
 *  $query = 'SELECT * FROM my_table';
 *
 *  -- Initialize new class instance and download file like this:
 *  new SQL2CSV($params, $query);
 *  -- if you want to print column headers
 *  -- or
 *  new SQL2CSV($params, $query, false);
 *  -- if you do not want to print column headers
 *
 *  That's it.
 *  The query will be executed,
 *  data printed to .csv file and user be prompted to download the file.
 *  
 *  After creating the file you can insert anchors into your HTML document like this:
 *  <a href="dump_data.php">Dump database dump</a>
 *  
 *  You can modify the code to accept query string through $_GET variable
 *  In that case you must change the following line in 'dump_data.php':
 *    $query = 'SELECT * FROM my_table';
 *  to
 *    $query = urldecode($_GET['query']);
 *  or whatever you name your $_GET variable
 */

    class SQL2CSV {
        // initialize the class with passed parameters
        function SQL2CSV($params, $query, $print_captions = true) {
            // set initial .csv file contents
            $CSV = '';
            $FILENAME = 'database_dump.csv';
            
            // connect to MySQL database
            $link = mysql_connect($params['host'], $params['user'], $params['password']) or die(mysql_error());
            // start using the required database
            $db = mysql_select_db($params['database'], $link);
            
            // execute query to get the data required
            $res = mysql_query($query, $link) or die(mysql_error());
            $colnames = array();
            
            // get column captions and enclose them in doublequotes (") if $print_captions is not set to false
            if ($print_captions) {
                for ($i = 0; $i < mysql_num_fields($res); $i++) {
                    $fld = mysql_fetch_field($res, $i);
                    $colnames[] = '"'.$fld->name.'"';
                }
                // insert column captions at the beginning of .csv file
                $CSV .= implode(";", $colnames);
            }
            
            // iterate through each row
            // replace single double-quotes with double double-quotes
            // and add values to .csv file contents
            if (mysql_num_rows($res) > 0) {
                while ($row = mysql_fetch_array($res, MYSQL_NUM)) {
                    for ($i = 0; $i < sizeof($row); $i++)
                        $row[$i] = '"'.str_replace('"', '""', $row[$i]).'"';

                    $CSV .= "\n".implode(";", $row);
                }
            }

            // send output to browser as attachment (force to download file
            header('Expires: Mon, 1 Jan 1990 00:00:00 GMT');
            header('Last-Modified: '.gmdate("D,d M Y H:i:s").' GMT');
            header('Pragma: no-cache');
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename='.$FILENAME);
            // print the final contents of .csv file
            print $CSV;
        }
    }
?> 