<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
 $firstname = $_POST['firstname'];
 $lastname = $_POST['lastname'];
 $userid = $_POST['userid'];
 $email = $_POST['email'];
 $state = $_POST['state'];
 $gender = $_POST['gender'];
 $category = $_POST['category'];
 $mobile = $_POST['mobile'];
 $height = $_POST['height'];
 $bmi = $_POST['bmi'];
 $qualification = $_POST['qualification'];
 $date = $_POST['date'];
 $region = $_POST['region'];


 
 if($firstname == '' || $lastname == '' || $email == ''||$state == '' ||$gender == '' ||$category == 'Category' ||$mobile == ''||$region == 'Select Region'||$height == ''||$bmi == ''||$qualification == 'Qualification'){
 echo 'please fill all values';
 }else{
 require_once('dbConnect.php');
 $sql = "SELECT * FROM NewUser WHERE email='$email'";
 
 $check = mysqli_fetch_array(mysqli_query($con,$sql));
 
 if(isset($check)){
 echo 'email already exist';
 }else{ 
 require_once('twoWay.php');
$hash=my_simple_crypt($userid,'e');
 $sql = "INSERT INTO NewUser (firstname,lastname,state,gender,category,mobile,email,height,bmi,region,qualification,date,userid) VALUES('$firstname','$lastname','$state','$gender','$category','$mobile','$email','$height','$bmi','$region','$qualification',CURDATE(),'$hash')";
 if(mysqli_query($con,$sql)){
 echo 'successfully registered';
 }else{
 echo 'oops! Please try again!';
 }
 }
 mysqli_close($con);
 }
}else{
echo 'error';
}