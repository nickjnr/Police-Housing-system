<?php
class database{    

public function dbConnect() {        
    
$servername ="localhost:3306"; 
$username = "root";
$password =""; 
$dbname="policeh"; 

$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    
  die("Connection failed: " . $conn->connect_error);
}
        return $conn;   
        echo $conn;
    }  


function sendSms($phoneNumber,$message){
        $apiKey="dcea59ec269e4e219bb697bdbc35bd9c0444f34463987fc12d928c5041bc0f04";
        $sendeName="23107";
    
        $bodyRequest =array(
            "mobile" =>$phoneNumber,
            "response_type"=>"json",
            "sender_name"=>$sendeName,
            "service_id"=>0,
            "message"=>$message
        );
        $payload = json_encode($bodyRequest);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mobitechtechnologies.com/sms/sendsms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$payload,
        CURLOPT_HTTPHEADER => array(
            'h_api_key: '.$apiKey,
            'Content-Type: application/json'
        ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    
    }

function generateAndHashPassword($length = 12) {
    // Define the character pool for the password
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}[]<>?';

    // Generate a random password
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Hash the password using PASSWORD_DEFAULT algorithm
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Return the generated password and hashed version
    return array('password' => $password, 'hashedPassword' => $hashedPassword);
}


}