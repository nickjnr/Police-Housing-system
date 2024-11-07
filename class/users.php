<?php
require "database.php";

class users extends Database{
    private $productId;
    public function addofficer(){        
   $conn=$this->dbConnect();
    
        $find="select * from officers where officer_no='{$_POST['officerNo']}'";
        $search= $conn->query($find);
        $num=mysqli_num_rows($search); 
      
       if($num<=0){
             if($_POST['housetype']=='apartment'){
                $officertype='normal';
             }else if($_POST['housetype']=='single'){
                $officertype='senior';

             }
             $date=Date("Y-m-d");
        $sql= "INSERT INTO `officers` (`officer_name`, `Dob`, `officer_no`, `phone`,`gender`, `email`, `familysize`, `officer_type`, `building_id`, `house_no`) 
        VALUES ('{$_POST['Oname']}', '{$_POST['DoB']}', '{$_POST['officerNo']}', '{$_POST['phone']}','{$_POST['gender']}', '{$_POST['email']}', 
        '{$_POST['familysize']}', '$officertype', '{$_POST['houseId']}', '{$_POST['houseno']}')";

        if($conn->query($sql)){
            
          $conn->query("update houses set status='occupied' where building_id='{$_POST['houseId']}' and house_no='{$_POST['houseno']}'");
         $conn->query("insert into occupations (`building_id`,`house_no`,`from`,`officer_id`)
         values('{$_POST['houseId']}',
          '{$_POST['houseno']}','$date','{$_POST['officerNo']}')");
       $housename=$this->gethousename($_POST['houseId']);
       ob_start();
          $message="Dear Officer,You have been Asigned the following house:\n
          House Name:$housename\nHouse Type:{$_POST['housetype']}\nHouse NO:{$_POST['houseno']}";
          $this->sendSms($_POST['phone'],$message);
       ob_clean();
        } 
       
       }
       echo json_encode(1);
      
    }

public function housedetails($id){

    $id=$id;
    $conn=$this->dbConnect();
$results=$conn->query("select building_id, house_no from officers where id='$id'");
$datas=$results->fetch_assoc();
return $datas;

}

public function gethousename($id){

    $id=$id;
    $conn=$this->dbConnect();
$results=$conn->query("select project_name from buildings where building_id='$id'");
$datas=$results->fetch_assoc();
return $datas['project_name'];

}
    public function Update(){  
        
        
        $conn=$this->dbConnect();
         $record=$_POST['recordid'];
       $data=$this->housedetails($record);
      
       $house=$data['house_no'];
       $building=$data['building_id'];


            
                  if($_POST['housetype']=='apartment'){
                     $officertype='normal';
                  }else if($_POST['housetype']=='single'){
                     $officertype='senior';
     
                  }

            $date=Date("Y-m-d");
            if(($_POST['houseId']=='' && $_POST['houseno']=='')){
   
                $sql= "update  officers
                set officer_name='{$_POST['Oname']}', Dob='{$_POST['DoB']}',
                officer_no={$_POST['officerNo']}, gender='{$_POST['gender']}', email='{$_POST['email']}', 
                familysize='{$_POST['familysize']}',phone='{$_POST['phone']}' where id=$record";
                  
                 if($conn->query($sql)){
             echo json_encode(1);

             } 

            }
            else if(($_POST['houseId'] == '' && $_POST['houseno'] != '') ||
            ($_POST['houseId'] != '' && $_POST['houseno'] == '') ){
               echo  json_encode(2);

            }else{

                $sql= "update  officers
                set officer_name='{$_POST['Oname']}', Dob='{$_POST['DoB']}',
                officer_no={$_POST['officerNo']}, gender='{$_POST['gender']}', email='{$_POST['email']}', 
                familysize='{$_POST['familysize']}', officer_type='$officertype', building_id='{$_POST['houseId']}', 
                house_no={$_POST['houseno']},phone='{$_POST['phone']}' where id=$record";
                
                
                if($conn->query($sql)){

 
                    $conn->query("update houses set status ='vacant' where building_id='$building' and house_no=$house");
                    $conn->query("update occupations set leave_date='$date' where building_id = '$building' and house_no =$house");
                  
                    $conn->query("update houses set status='occupied' where building_id='{$_POST['houseId']}' and house_no='{$_POST['houseno']}'");
                    $conn->query("insert into occupations (`building_id`,`house_no`,`from`,`officer_id`)
                    values('{$_POST['houseId']}',
                     '{$_POST['houseno']}','$date','{$_POST['officerNo']}')");
                    echo json_encode(3);
       
                    } 

            
            }
                       
         }

public function reset($token,$password){
    $token=$token;
    $password=$password;
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $conn=$this->dbConnect();
    $sql='update users set password=? where token=?';
    $stmt= $conn->prepare($sql); 
    $stmt->bind_param("ss",$password,$token);
    $stmt->execute();
    $conn->close();
}

    public function login($email,$password){
        $email=$email;
        $password=$password;
        $sql="select password from users where username=?";
        $conn=$this->dbConnect();
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $results=$stmt->get_result();
        $data=$results->fetch_assoc();
        
        if($data==null){
           $value=0;
        }
        else
        {
        
        $hashedp=$data['password'];
        $checkpass=password_verify($password,$hashedp);
         if($checkpass==false){
        $value=0;
         }
         else{  
  session_start();
             
            if($email==='Super@administrator'){
                  $_SESSION['admin']=$email; 
                  $value=1;
            }else{
                  $_SESSION['userid']=$email; 
                  $value=2;
            }
         
            
            
         } 
        }

        echo json_encode($value);

        $conn->close();
     }
   
public function resetemail($email){
        $sql="select token from users where email=?";
        $conn=$this->dbConnect();
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();
if(mysqli_num_rows($result)==1){
    $token=$result->fetch_assoc();
    
    return $token['token'];
}else{
    $zero=0;
    echo $zero;
}
$conn->close();  

     }


public function Admin(){
    $passwordData = $this->generateAndHashPassword();
    $password= $passwordData['password'];
    $hashed=$passwordData['hashedPassword'];
  $email=$_POST['email'];
    $conn=$this->dbConnect();
    $sql="INSERT INTO `admin` (`username`, `password`) VALUES ('$email', '$hashed')";
     
     
$find="select*from admin where username='{$_POST['email']}'";
$results=$conn->query($find);
$num=mysqli_num_rows($results);

if($num==0){
    if( $conn->query($sql)){
     $data=1;
     $message="Your Username is:{$_POST['email']}\n\nPassword:$password\n\nFrom:Police Housing System";
    $this->sendSms($_POST['phone'],$message);
    header('location:signup.php?success');
    }
    else{
       header('location:signup.php?error');
    }

}else{
    $data=0;  
}

}
     
      
      
}?>