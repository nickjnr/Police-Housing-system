<?php
require 'database.php';
class trips extends database{
	
public function destinations(){
		$conn=$this->dbConnect();
		$sql="select destination from destinations";
        $destinations=$conn->query($sql);
		return $destinations;
	}

	public function Tdrivers(){
		$conn=$this->dbConnect();
		$sql="select lname,fname,idno from drivers";
        $drivers=$conn->query($sql);
		return $drivers;
	}


	public function Ttruck(){
		$conn=$this->dbConnect();
		$sql="select plateno from cars";
        $cars=$conn->query($sql);
		return $cars;
	}

	public function station(){
		$conn=$this->dbConnect();
		$sql="select * from fuelstations";
        $cars=$conn->query($sql);
		return $cars;
	}




public function liststations(){
	$conn=$this->dbConnect();
	$sql="select*from fuelstations";

	if(!empty($_POST["search"]["value"])){
		$sql .= ' where location LIKE "%'.$_POST["search"]["value"].'%" ';					
						
	}
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sql .= ' ORDER BY id ASC ';
	}
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	
	
	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$stationData = array();
    while($row=$results->fetch_assoc()){
		$tripRows = array();
		
	$stationRows[] = $row['location'];
    $stationRows[] =  $row['phone'];
	$uid =  $row['id'];
	$stationRows[] =  "<button class='btn btn-danger' id='deletestation' value='$uid' style='font-size:10px'>Delete</button>
	<button class='btn btn-dark' id='editstation' value='$uid' style='font-size:10px'>Edit</button>
	<button class='btn btn-success' id='viewstation' value='$uid' style='font-size:10px'>View</button>
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

public function listtrips(){
	$conn=$this->dbConnect();
	$sql="select*from trips";

	if(!empty($_POST["search"]["value"])){
		$sql .= ' where trip_id LIKE "%'.$_POST["search"]["value"].'%" ';					
		$sql .= ' OR Vehiclereg LIKE "%'.$_POST["search"]["value"].'%" ';
		$sql .= ' OR destination LIKE "%'.$_POST["search"]["value"].'%" ';					
	}
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sql .= ' ORDER BY trip_id DESC ';
	}
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	
	
	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$tripData = array();
    while($row=$results->fetch_assoc()){
		$tripRows = array();
		
	$tripRows[] = $row['trip_id'];
    $tripRows[] =  $row['Vehiclereg'];
    $tripRows[] =  $row['departuredate'];
    $tripRows[] =  $row['driver'];		
    $tripRows[] =  $row['destination'];
    $tripRows[] =  $row['distance'];
	$uid =  $row['trip_id'];
	$tripRows[] =  "
	<div style='text-align:center'>
	<button class='btn btn-danger' id='deletetrip' value='$uid' style='font-size:10px'>Delete</button>
	<button class='btn btn-dark' id='edittrip' value='$uid' style='font-size:10px'>Edit</button>
	<button class='btn btn-success' id='viewtrip' value='$uid' style='font-size:10px'>View</button>
	
</div>
	";
    $tripData[] = $tripRows;
    }

		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$tripData
		);
		echo json_encode($output);
}







public function fuelconsumption(){
	
	$conn=$this->dbConnect();
	$sql="SELECT
    t.trip_id,
    t.estimatedconsumption,t.Vehiclereg,
    COALESCE(fr.no_of_liters, 0) AS fuel_request  FROM trips t LEFT JOIN
    requests fr ON t.trip_id=fr.trip_id";

	/*if(!empty($_POST["search"]["value"])){
		$sql .= ' where t.trip_id LIKE "%'.$_POST["search"]["value"].'%" ';					
		$sql .= ' OR t.Vehiclereg LIKE "%'.$_POST["search"]["value"].'%" ';
	
       // $sql.=' And driver ='.$driver ;				
	}
    else{
       // $sql.=' where driver ='.$driver ;
    }
	
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sql .= ' ORDER BY trip_id DESC ';
	}
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	} */
	
	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$tripData = array();
    while($row=$results->fetch_assoc()){
		$request= $row['fuel_request'];
		$estimate= $row['estimatedconsumption'];
		$total=$request*$estimate;
		echo"
		<tr><td> {$row['trip_id']}</td>";
		echo"<td> {$row['Vehiclereg']}</td>";
		echo"<td> $estimate</td>";
		echo"<td> $request</td>";
		echo"<td> $total</td></tr>";

		/*;
	$tripRows = array();
	$tripRows[] = $row['trip_id'];
    $tripRows[] =  $row['Vehiclereg'];
    $tripRows[] =  $estimate;
    $tripRows[] =  $request;
    $tripRows[] =  $estimate+$request;
	$uid =  $row['trip_id'];
	$tripRows[] =  "
	<div style='text-align:center'>

	<button class='btn btn-success' id='viewtrip' value='$uid' style='font-size:10px'>View</button>
	<button class='btn btn-info' id='requestfuel' value='$uid' style='font-size:10px'>Request Fuel</button>
</div>
	";
    $tripData[] = $tripRows;*/
    }

		/*$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$tripData
		);
		echo json_encode($output);*/
}


public function drivertrips($id){
	$driver=$id;
	$conn=$this->dbConnect();
	$sql="select*from trips";

	if(!empty($_POST["search"]["value"])){
		$sql .= ' where trip_id LIKE "%'.$_POST["search"]["value"].'%" ';					
		$sql .= ' OR Vehiclereg LIKE "%'.$_POST["search"]["value"].'%" ';
		$sql .= ' OR destination LIKE "%'.$_POST["search"]["value"].'%" ';	
        $sql.=' And driver ='.$driver ;				
	}
    else{
        $sql.=' where driver ='.$driver ;
    }
	
	if(!empty($_POST["order"])){
		$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sql .= ' ORDER BY trip_id DESC ';
	}
	if($_POST["length"] != -1){
		$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	} 
	
	$results=$conn->query($sql);
	$numRows=mysqli_num_rows($results);
	$tripData = array();
    while($row=$results->fetch_assoc()){
	$tripRows = array();
	$tripRows[] = $row['trip_id'];
    $tripRows[] =  $row['Vehiclereg'];
    $tripRows[] =  $row['departuredate'];
    $tripRows[] =  $row['destination'];
    $tripRows[] =  $row['distance'];
	$uid =  $row['trip_id'];
	$tripRows[] =  "
	<div style='text-align:center'>

	<button class='btn btn-success' id='viewtrip' value='$uid' style='font-size:10px'>View</button>
	<button class='btn btn-info' id='requestfuel' value='$uid' style='font-size:10px'>Request Fuel</button>
</div>
	";
    $tripData[] = $tripRows;
    }

		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$tripData
		);
		echo json_encode($output);
}


public function insert(){
$conn=$this->dbConnect();
	$reg=$_POST["car"];
	$sdate=$_POST["sdate"];
	$driver=$_POST["driver"];
	$destination=$_POST["destination"];
	$driver=$_POST["driver"];
    $destinationdetails="select*from destinations where destination='$destination'";

	$deD=$conn->query($destinationdetails);
	while($data=$deD->fetch_assoc()){
		$distance=$data['distance'];
		$fuel=$data['fuel'];
	}
	$charity=$distance*2;

  $sql="
  INSERT INTO `trips` (`trip_id`, `Vehiclereg`, `driver`, `departuredate`, 
  `destination`, `distance`, `departuretime`, `arrivaltime`, `estimatedconsumption`, `hrs_travelled`, `rate_per_hr`, `charity_fee`)
   VALUES (NULL, '$reg', '$driver', '$sdate', '$destination', '$distance', '', '', '$fuel', '', '', '$charity')";

$find="select*from trips where driver='$driver' and departuredate='$sdate' and Vehiclereg='$reg'";
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

public function requests(){
	$conn=$this->dbConnect();
    $sql="SELECT req.location,req.no_of_liters as ltrs,req.request_id,tr.trip_id,drv.idno,drv.fname,drv.lname,drv.phone,sta.location,sta.phone as phoneno FROM
    requests req JOIN trips tr ON req.trip_id = tr.trip_id JOIN drivers drv ON tr.driver = drv.idno JOIN 
    fuelstations sta ON req.location = sta.id ";

$num=0;
if(!empty($_POST["search"]["value"])){
    $sql .= ' where drv.fname LIKE "%'.$_POST["search"]["value"].'%" ';					
    $sql .= ' OR drv.lname LIKE "%'.$_POST["search"]["value"].'%" ';
    $sql .= ' OR idno LIKE "%'.$_POST["search"]["value"].'%" ';					
    $sql.=' And req.status ='.$num ;				
}

else{
    $sql.=' where req.status ='.$num ;
}

if(!empty($_POST["order"])){
    $sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $sql .= ' ORDER BY req.location DESC ';
}

if($_POST["length"] != -1){
    $sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}	

$results=$conn->query($sql);
$numRows=mysqli_num_rows($results);
$requestData = array();
while($row=$results->fetch_assoc()){
    $requestRows = array();
	$name=$row['fname'].' '.$row['lname'];
        $requestRows[] =  $row['trip_id'];
        $requestRows[] =  $name;
        $requestRows[] =  $row['phone'];
        $requestRows[] =  $row['location'];		
       
        $requestRows[] =  $row['phoneno'];
		$requestRows[] =  $row['ltrs'];
        $uid=$row['request_id'];
        $id=$row['trip_id'];
       
        $requestRows[] =  "<button class='btn btn-danger' id='deletedriver' value='$uid' style='font-size:10px'>Delete</button>
        <button class='btn btn-dark' id='approverequest' value='$uid' style='font-size:10px'>Approve</button>
        <button class='btn btn-success' id='viewtrip' value='$id' style='font-size:10px'>View</button>
        ";
        $requestData[] = $requestRows;
}
    $output = array(
        "draw"				=>	intval($_POST["draw"]),
        "recordsTotal"  	=>  $numRows,
        "recordsFiltered" 	=> 	$numRows,
        "data"    			=> 	$requestData
    );
    echo json_encode($output);

}


public function insertrequest(){
	$conn=$this->dbConnect();
		$trip_id=$_POST["tripid"];
		
		$location=$_POST["location_id"];
		$fuel=$_POST["fuel"];
	
	  $sql="
	  INSERT INTO `requests` (`location`, `no_of_liters`, `status`, `trip_id`) VALUES ('$location', '$fuel', '0', '$trip_id')";


	  		if($conn->query($sql)){
			echo json_encode(1);
		}
	
else{
		echo json_encode(0);
	
	
	}}



	
public function Approverequest($id){
	$requestId=$id;
	$conn=$this->dbConnect();
	
	
	  $sql="Update requests set status=1 where request_id=$requestId";
	 /* $Phone=$this->getmobile($requestId);
	  $this->sendSms($Phone,"Test");*/

	  		if($conn->query($sql)){

			echo json_encode(1);
		}
	
else{
		echo json_encode(0);
	
	
	}}

	public function getmobile($id){
		$id=$id;
    $conn=$this->dbConnect();
	$sql="select  f.phone,r.no_of_liters from requests r left join fuelstations f on r.location=f.id where r.request_id=$id";
    $results=$conn->query($sql);
	$row=$results->fetch_assoc();
	return $row['phone'];
	
	}
	

public function addstation(){
	$conn=$this->dbConnect();
		$location=$_POST["location"];
		$phone=$_POST["phone"];
		
	  $sql="
	  INSERT INTO `fuelstations` (`location`, `phone`)
	   VALUES ( '$location', '$phone')";
	
	$find="select*from fuelstations where phone='$phone'";
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
	

public function data($id){
    $id=$id;
    $conn=$this->dbConnect();
        $sqlQuery = "
            SELECT * FROM trips
            WHERE trip_id = '$id'";
        $result = $conn->query($sqlQuery);	
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo json_encode($row);
    }

    public function delete($id){
        $id=$id;
        
        $conn=$this->dbConnect();
        
        if($conn->query("delete from trips where trip_id='$id'")){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
        
        }


		public function MainstationReq(){
			$conn=$this->dbConnect();
			$sql="SELECT req.location,req.no_of_liters as ltrs,req.request_id,tr.trip_id,drv.idno,drv.fname,drv.lname,drv.phone,sta.location,sta.phone as phoneno FROM
			requests req JOIN trips tr ON req.trip_id = tr.trip_id JOIN drivers drv ON tr.driver = drv.idno JOIN 
			fuelstations sta ON req.location = sta.id ";
		
		$num=1;
		$zero=0;
		$loc=3;
		if(!empty($_POST["search"]["value"])){
			$sql .= ' where drv.fname LIKE "%'.$_POST["search"]["value"].'%" ';					
			$sql .= ' OR drv.lname LIKE "%'.$_POST["search"]["value"].'%" ';
			$sql .= ' OR idno LIKE "%'.$_POST["search"]["value"].'%" ';					
			$sql.=' And req.status ='.$num ;	
			 $sql.=' And req.location ='.$loc ;	
			 $sql.=' And tr.main_lts_fueled ='.$zero ;			
		}
		
		else{
			$sql.=' where req.status ='.$num ;
			$sql.=' And req.location ='.$loc ;
			$sql.=' And tr.main_lts_fueled ='.$zero ;
		}
		
		if(!empty($_POST["order"])){
			$sql .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sql .= ' ORDER BY req.location DESC ';
		}
		
		if($_POST["length"] != -1){
			$sql .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	

		$results=$conn->query($sql);
		$numRows=mysqli_num_rows($results);
		$requestData = array();
		while($row=$results->fetch_assoc()){
			$requestRows = array();
			$name=$row['fname'].' '.$row['lname'];
				$requestRows[] =  $row['trip_id'];
				$requestRows[] =  $name;
				$requestRows[] =  $row['phone'];
				$requestRows[] =  $row['location'];		
			   $ltrs=  $row['ltrs'];
				$requestRows[] =  $row['phoneno'];
				$requestRows[] =$ltrs;
				$uid=$row['request_id'];
				$id=$row['trip_id'];
			   
				$requestRows[] ="
				<button class='btn btn-success' id='recordrequest' trip='$id' ltrs='$ltrs' value='$uid' style='font-size:12px'>Record Ltrs Fueled</button>
				";
				$requestData[] = $requestRows;
		}
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$requestData
			);
			echo json_encode($output);
		
		}public function  MainstationRecord(){

			$conn=$this->dbConnect();
        
        if($conn->query("update trips set main_lts_fueled ={$_POST['litres']} where trip_id='{$_POST['mainTrip']}'")){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
		}public function pasttrips(){
			$sql="SELECT
			t.trip_id,t.destination,t.estimatedconsumption
			t.main_lts_fueled,
			SUM(fr.no_of_liters) AS total_requested_fuel,
			(t.main_lts_fueled + COALESCE(SUM(fr.no_of_liters), 0)) AS total_consumption
		FROM
			trips t
		LEFT JOIN
			requests fr ON t.trip_id = fr.trip_id
		GROUP BY
			t.trip_id, t.main_lts_fueled;";

           $conn=$this->dbConnect();
          $results=$conn->query($sql);
		$numRows=mysqli_num_rows($results);
		$requestData = array();
		while($row=$results->fetch_assoc()){
			$requestRows = array();
			$name=$row['fname'].' '.$row['lname'];
				$requestRows[] =  $row['trip_id'];
				$requestRows[] =  $name;
				$requestRows[] =  $row['phone'];
				$requestRows[] =  $row['location'];		
			   $ltrs=  $row['ltrs'];
				$requestRows[] =  $row['phoneno'];
				$requestRows[] =$ltrs;
				$uid=$row['request_id'];
				$id=$row['trip_id'];
			   
				$requestRows[] ="
				<button class='btn btn-success' id='recordrequest' trip='$id' ltrs='$ltrs' value='$uid' style='font-size:12px'>Record Ltrs Fueled</button>
				";
				$requestData[] = $requestRows;
		}
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$requestData
			);
			echo json_encode($output);



		}

}?>