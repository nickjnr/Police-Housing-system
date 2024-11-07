<?php
require 'database.php';
class cars extends database{
public function listcars(){
	$conn=$this->dbConnect();
	$sql="select*from cars";

	if(!empty($_POST["search"]["value"])){
		$sql .= ' where plateno LIKE "%'.$_POST["search"]["value"].'%" ';					
		$sql .= ' OR model LIKE "%'.$_POST["search"]["value"].'%" ';
		$sql .= ' OR fuelcapacity LIKE "%'.$_POST["search"]["value"].'%" ';					
	}
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sql .= ' ORDER BY id DESC ';
	}
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	
	
	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$carData = array();
    while($row=$results->fetch_assoc()){
		$carRows = array();
			$carRows[] = $row['plateno'];
			$carRows[] =  $row['model'];
			$carRows[] =  $row['insurancedate'];		
			$carRows[] =  $row['insuranceexpiry'];
			$carRows[] =  $row['fuelcapacity'];
			$carRows[] =  $row['driver_id'];
			$carData[] = $carRows;
    }

		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$carData
		);
		echo json_encode($output);
}

public function insert(){
	$reg=$_POST["reg"];
	$sdate=$_POST["sdate"];
	$expiry=$_POST["expiry"];
	$capacity=$_POST["capacity"];
	$model=$_POST["model"];
	$driver=$_POST["driver"];
  $sql="
	INSERT INTO `cars` (`plateno`, `insurancedate`, `insuranceexpiry`, `fuelcapacity`, `model`, `driver_id`) VALUES
	 ('$reg', '$sdate', '$expiry', '$capacity', '$model', '$driver')";
$conn=$this->dbConnect();

$find="select*from cars where plateno='$reg'";
$results=$conn->query($find);
$num=mysqli_num_rows($results);
if($num==0){
	if($conn->query($sql)){
		echo json_encode(1);
	}
	
}else{
	echo json_encode(0);
}
	


}

}?>