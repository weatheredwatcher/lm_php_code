<?php
/**
 *    This Class Can Be Used to Read A Csv File
 *    Author  :  aneeshrp@gmail.com
 *    Package :  CSV Reader
 *    Version :  1.0
 *    Created Date : 12 Sep 2007
 *    modified: 10/05/2009 DWD
 *
 * Change Log:
 * 10/05/2009 DWD modified paths to showDataTable to reflect is location in the new application
 * 10/05/2009 DWD Changed the array out put to a session array $_SESSION['data_Array']
 */

class CSV_Reader
{
	/**
	 * Path where the Csv File Located
	 */
	public $strFilePath       =     NULL;
	
	/**
	 * How Much data (in bytes) should be readed
	 */
	public $intLengthToRead   =     NULL;	
	
	/**
	 * Output Mode {whether to show or to retrive
	 */
	 public $strOutPutMode    =     NULL;
	 
	/**
	 * Storage Area For Processed Data
	 */
	public $arrOutPut         =     array();
	
	
	/**
	 *  Check Whether the Given File is avlid one or not
	 *  @param NULL
	 *  $return boolean
	 */
	function isFileExists ()
	{ 
		$boolFileExists     =     false; 
		if ( file_exists ( $this->strFilePath ) ) {
			$boolFileExists     =     true;
		}
		return $boolFileExists;
	}
	
	/**
	 * Set a default configuration if user left blank
	 * @param NULL
	 * $return boolean
	 */	 
	function setDefaultConfiguration ()
	{
		$boolSetConfig     =     false;
		
		// Default Value for Length to read
		if ( NULL == $this->intLengthToRead ) {
			$this->intLengthToRead     =     1000;	
		}		
		
		// Default Value For Output Mode
		if( NULL  ==  $this->strOutPutMode ) {
			$this->strOutPutMode     =     0;
		}
		
	}
	
	/**
	 *  Read the CSV File and Produces The Output
	 */
	function readTheCsv ()
	{
		$resFileHandler     =     NULL;
		$arrData            =     array();
		
		$resFileHandler     =     $this->openCsvFile();
		
		while (  $arrData   =     fgetcsv ( $resFileHandler, $this->intLengthToRead, "," )){ 
				$this->arrOutPut[]     =     $arrData;
		}   
	}
	/**
	 *  Open the Given File
	 *  return resource
	 */
	function openCsvFile ()
	{
		$resFileHandler     =     NULL;
		if( true == $this->isFileExists () ) {
			$resFileHandler     =     fopen ( $this->strFilePath, 'r' )	;
		}
		return $resFileHandler;	
	}
	/**
	 *  Giving the Out Put to User
	 */
	function printOutPut () {
		if (  1  == $this->strOutPutMode ) {
			$this->alert(1); 
		} else { 
			$this->alert(0);// Comment this Line Before Using this Script
			return $this->arrOutPut;
			 
		}		
	}
	/**
	 *  Informs User Regarding the Output
	 *  @param int 
	 *  $return NULL
	 */
	function alert($intVal)
	{
		$Data     =     $this->arrOutPut;
		if( 1  ==  $intVal ) {
			$this->showTemplate();
		} else {
                            $_SESSION['data_Array'] = $Data;
                            echo '<pre>';print_r($_SESSION['data_Array']); echo '</pre>';
		}
	}
	/**
	 *  Show Out put in HTML Format
	 */
	function showTemplate ()
	{
		$Data     =     $this->arrOutPut;
		require_once('includes/showDataTable.php');
	}
	 
}