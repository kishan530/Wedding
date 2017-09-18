<?php
include("config.php");
$Name = $Email = $PhoneNumber = $Message = '';
$Name=$_POST["Name"];
$Email=$_POST["Email"];
$PhoneNumber=$_POST["PhoneNumber"];
$Message=$_POST["Message"];
//echo "hello orld";
/*$Name="hello";
$Email="hello@gmail.com";
$PhoneNumber="123456";
$Message="hello mot";*/
$messageBody="";
//echo("HELOO VENU HOW R U");
//$conn=mysqli_connect('localhost','root','','wedelicious');
if($conn->connect_error){
die("connection error :" . $conn->connect_error);
}
$sql=mysqli_query($conn,"insert into contact_us(Name,Email,PhoneNumber,Message,active)values('$Name','$Email','$PhoneNumber','$Message','1')");
//if($sql);
//echo (mysqli_error($conn));

//require_once('sendemail.php'); 

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

  //	header("location:/preview/#!/contactsuccess");	

?>