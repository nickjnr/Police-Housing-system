<?php
require 'database.php';
class houses extends database{

public function listOfficers(){
        $conn=$this->dbConnect();
        $sql="select of.phone,of.officer_type, of.house_no,of.officer_no, of.officer_name,of.date, of.Dob, of.building_id,
        b.project_name,of.gender,of.email,of.officer_type from officers of left join buildings b on b.building_id= of.building_id";
    
        if(!empty($_POST["search"]["value"])){
            $sql .= ' where fname LIKE "%'.$_POST["search"]["value"].'%" ';					
            $sql .= ' OR of.officer_name LIKE "%'.$_POST["search"]["value"].'%" ';
            $sql .= ' OR of.Dob LIKE "%'.$_POST["search"]["value"].'%" ';					
        }
        if(!empty($_POST["order"])){
            $sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sql .= ' ORDER BY of.officer_type DESC ';
        }
        if($_POST["length"] != -1){
            $sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }	
        
        $results=$conn->query($sql);
        $numRows=mysqli_num_rows($results);
        $driverData = array();
        while($row=$results->fetch_assoc()){
            $driverRows = array();
                $driverRows[] = $row['officer_name'];
                $driverRows[] =  $row['gender'];
                $driverRows[] =  $row['officer_type'];
                $driverRows[] =  $row['Dob'];
                $driverRows[] =  $row['email'];		
                $driverRows[] =  $row['phone'];	
                $driverRows[] =  $row['project_name'];
                $driverRows[] =  $row['house_no'];
                $uid=$row['officer_no'];
                $driverRows[] =  $row['date'];
                
                $driverRows[] =  "<button class='btn btn-danger vacate' id='deletedriver' value='$uid' style='font-size:10px'>Vacate</button>
                <button class='btn btn-dark' id='editdriver' value='$uid' style='font-size:10px'>Delete</button>
                <button class='btn btn-success editofficer' building_id='' value='$uid' style='font-size:10px'>Edit</button>
                ";
                $driverData[] = $driverRows;


}
    
            $output = array(
                "draw"				=>	intval($_POST["draw"]),
                "recordsTotal"  	=>  $numRows,
                "recordsFiltered" 	=> 	$numRows,
                "data"    			=> 	$driverData
            );
            echo json_encode($output);

    }

public function add() {

$conn=$this->dbConnect();
$id=uniqid();
    $sql="INSERT INTO `buildings` (`house_type`, `project_name`, `no_of_rooms`, `no_of_houses`, `building_id`) VALUES 
    ('{$_POST['housetype']}', '{$_POST['Bname']}', '{$_POST['no_of_rooms']}', '{$_POST['no_of_houses']}', '$id')";

    $no=$_POST['no_of_houses'];
    if($conn->query($sql)){
        for($x=1;$x<=$no;$x++){
            $sql2="INSERT INTO `houses` (`house_no`, `building_id`, `status`) VALUES ($x, '$id', 'vacant')";
            $conn->query($sql2);
           }

    }
  
echo json_encode (1);
}


public function getHouses($type){
    $type=$type;

  $sql="select * from Buildings where house_type=?";
     $data=array();
     $conn=$this->dbConnect();
     $stmt=$conn->prepare($sql);
     $stmt->bind_param("s",$type);
     $stmt->execute();
     $results=$stmt->get_result();
  while ($row = $results->fetch_assoc()) {
      $data[] = $row;
  }
     echo json_encode($data);
  }


  
public function getHouseNo($id){
    $id=$id;

  $sql="select * from houses where building_id=? and status='vacant'";
     $data=array();
     $conn=$this->dbConnect();
     $stmt=$conn->prepare($sql);
     $stmt->bind_param("s",$id);
     $stmt->execute();
     $results=$stmt->get_result();
  while ($row = $results->fetch_assoc()) {
      $data[] = $row;
  }
     echo json_encode($data);
  }

public function data($id){
    $id=$id;
    $conn=$this->dbConnect();
        $sqlQuery = "
        SELECT f.*,b.project_name FROM officers f left join buildings b on f.building_id=b.building_id
            WHERE officer_no = '$id'";
        $result = $conn->query($sqlQuery);	
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo json_encode($row);
}
    public function delete($id){
        $id=$id;
        
        $conn=$this->dbConnect();
        
        if($conn->query("delete from drivers where uniqid='$id'")){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
        
        }

        public function update($id){
            $id=$id;
                $conn=$this->dbConnect();
                $sql="UPDATE `drivers` SET `fname` = '{$_POST['fname']}', `lname` = '{$_POST['lname']}', `dateofbirth` = '{$_POST['DoB']}',
                 `idno` = '{$_POST['idno']}', `Gender` = '{$_POST['gender']}', `email` = '{$_POST['email']}', `phone` = '{$_POST['phone']}',
                  `nextofkinname` = '{$_POST['kinname']}', `nextofkinphone` = '{$_POST['kinphone']}'
                 WHERE `drivers`.`uniqid` =$id";

            if( $conn->query($sql)){
                $data=4;
               }else{
                   $data=2;
               }
               echo json_encode($data);
            
            }

       
public function listHouses(){
	$conn=$this->dbConnect();
	$sql="select*from buildings";

	if(!empty($_POST["search"]["value"])){
		$sql .= ' where project_name LIKE "%'.$_POST["search"]["value"].'%" ';					
						
	}
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} 
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	
	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$stationData = array();
    while($row=$results->fetch_assoc()){
	$stationRows = array();
	$stationRows[] = $row['project_name'];
    $stationRows[] =  $row['house_type'];
    $stationRows[] =  $row['no_of_houses'];
	$uid =  $row['building_id'];
	$stationRows[] =  "
	<a href='housedetails.php?id=$uid' class='btn btn-success' id='viewstation' value='$uid' style='font-size:10px'>View House Status</a>
	";
    $stationData[] = $stationRows;
    }

		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$stationData
		);
		echo json_encode($output);
}

public function housestatus($house,$id){

    $id=$id;
    $house=$house;
    $conn=$this->dbConnect();
    $results=$conn->query("select h.status,b.project_name from houses h left join buildings b on h.building_id= b.building_id where h.building_id='$id' and h.house_no=$house");
    $row=$results->fetch_assoc();
 echo json_encode ($row);

}
public function updatestatus($house,$id){
    $id=$id;
    $house=$house;
    $conn=$this->dbConnect();
    $results=$conn->query("update houses set status ='{$_POST['status']}' 
    where building_id='$id' and house_no=$house");
 if($results){
    echo json_encode(0);

 }
}
public function listhousedetails($id){
    $id=$id;
	$conn=$this->dbConnect();
	$sql="select*from houses where building_id='$id'";

	/*if(!empty($_POST["search"]["value"])){
		$sql .= ' where project_name LIKE "%'.$_POST["search"]["value"].'%" ';					
						
	}
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} 
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}*/

	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$stationData = array();
    while($row=$results->fetch_assoc()){
	$stationRows = array();
    $house=$row['house_no'];
	$stationRows[] = $house;
    $stationRows[] =  $row['status'];
	$uid =  $row['building_id'];
if($row['status']=='occupied'){
    $stationRows[] =  "
	<button class='btn btn-success' disabled id='Changestatus' value='$uid' house='$house' style='font-size:10px'>Change Status</button>
	";
}else{
    $stationRows[] =  "
	<button class='btn btn-success' id='Changestatus' value='$uid' house='$house' style='font-size:10px'>Change Status</button>
	";
}
	

    $stationData[] = $stationRows;
    }

		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$stationData
		);
		echo json_encode($output);
}


}?>