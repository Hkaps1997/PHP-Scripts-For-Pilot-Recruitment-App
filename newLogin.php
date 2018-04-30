<?php 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $userid = $_POST['userid'];
 
 $email  = $_POST['email'];
 
 if($email==''||$userid=='')
 {
 echo 'Please enter all the values';
 }
 
 else{
 require_once('dbConnect.php');
 
 $sql = "SELECT * FROM NewUser WHERE email='".$email."'";
 
 $r = mysqli_query($con,$sql);
 
 $res = mysqli_fetch_array($r);
 
 if(!isset($res))
 {
 echo 'Incorrect email id';
 }
 else{
require_once('twoWay.php');

if(strcmp($userid,my_simple_crypt($res['userid'],'d'))!=0)
{
echo 'Incorrect user id';
}

else{
 $result = array();
 
 array_push($result,array(
 "firstname"=>$res['firstname'],
 "lastname"=>$res['lastname'],
 "state"=>$res['state'],
 "gender"=>$res['gender'],
 "category"=>$res['category'],
 "mobile"=>$res['mobile'],
 "email"=>$res['email'],
"height"=>$res['height'],
"bmi"=>$res['bmi'],
"qualification"=>$res['qualification'],
"region"=>$res['region'],
"userid"=>my_simple_crypt($res['userid'],'d')
 )
 );
 
 echo json_encode(array("result"=>$result));
 
 mysqli_close($con);
 }
 }}}
 
 else{
 echo 'error loading';
 }