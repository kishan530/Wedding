<?php

include("config.php");
$name = $email = $mobile = $created_at ='';
$name=$_GET["name"];
$email=$_GET["email"];
$mobile=$_GET["mobile"];
$created_at = new DateTime();
$created_at = $created_at->format('Y-m-d H:i:s');
 $errors= array();
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}

$sql="insert into contest(name,email,mobile,created_at)values('$name','$email','$mobile','$created_at')";

$data = array();
$data ['message'] = '';
$data ['stutus'] = false;
if (mysqli_query($conn, $sql)){
$data ['message'] = 'insert data successfully';
$data ['stutus'] = true;
 $last_id = mysqli_insert_id($conn);
 session_start();
 $_SESSION['contestId'] = $last_id;
 $data ['contestId'] = $last_id;


}else{
	$data ['message'] = mysqli_error($conn);
$data ['stutus'] = false;
//echo (mysqli_error($conn));
}

$outp['data'] =$data;
$conn->close();

echo(json_encode($outp));
$to      = "baddala.venugopalreddy@gmail.com";
                                     $subject = "testing";

                                    $headers = "From: " .$Email. "\r\n";
                                    $headers .= "Reply-To: ".$Email. "\r\n";
                                    
                                    $headers .= "MIME-Version: 1.0\r\n";
                                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                                    
                                    $messageBody .= '<body>
                                    <div class="div2" style=" width: 609px;  padding: 50px; background-color:#CCC;">
                                                                        <div class="div1" style=" background-color:white; border: 1px solid white;  margin-left: 30px; width: 550px; font-size:14px;">
                                                                                
                                                                                
                                          <h1>Contact Person  Message</h1>
                                          <p>
                                         <b> Name </b> :'. $Name .' </p>
                                          <p>
                                         <p>
                                         <b> Email </b> :'. $Email .' </p>
                                          <p>
										  <p>
                                         <b> PhoneNumber </b> :'. $PhoneNumber .' </p>
                                          <p>
                                        <b>Message </b> : '. $Message .' </p>';
                                            
                                            $messageBody .=' 
                                            </div>
                                    </div>
                                    </body>';
                              
                              mail($to, $subject, $messageBody, $headers);
?>