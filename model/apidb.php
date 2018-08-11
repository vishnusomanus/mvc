<?php
class apidb extends Model{ 
	public $mysqli;
	function __construct($con) {
		$this->mysqli = $con;
	}

	public function insertclario($data=array()){
		if (!empty($data)) {
			extract($data);

$allsqlquery = "INSERT INTO `webhook_temp` VALUES (NULL,'$alldata',NULL)";
$allresult = $this->mysqli->query($allsqlquery);
if ($allresult === TRUE) {
   $status['connected'] = TRUE;
}

			$sql_query = "INSERT INTO `webhook` VALUES (NULL,'$name','$mrn','$institution','$exam_time','$accession','$exam_date',NULL)";
			$result = $this->mysqli->query($sql_query);
			$status = array();
			if ($result === TRUE) {
				$status['status'] = true;
				$status['data'] = 'Dicom Details imported successfully';
			    return  $status;
			} else {
				$status['status'] = false;
				$status['data'] = "Error:".$this->mysqli->error;
			    return  $status;
			}
		}


	}




}