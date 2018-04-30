<?php 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $date1 = $_POST['date1'];
 
 $date2  = $_POST['date2'];
 
 if($date1==''||$date2=='')
 {
 echo 'Please enter all the values';
 }
 
 else{
 require_once('dbConnect.php');

if(strcmp($date1,$date2)==0)
 $sql = "SELECT * FROM NewUser WHERE date='".$date1."'";

else
$sql = "SELECT * FROM NewUser WHERE date BETWEEN '".$date1."' AND '".$date2."'";
 
 $r = mysqli_query($con,$sql);
$res1 = mysqli_fetch_array($r);

if(!isset($res1))
echo 'Invalid Dates Entered';


else{
require_once('twoWay.php');
  $result = array();
while($res = mysqli_fetch_assoc($r))
{
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
}
 
 
 echo json_encode(array("result"=>$result));
 
 mysqli_close($con);
 
 
 }}}
 else{
 echo 'error loading';
 }