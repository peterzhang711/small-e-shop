<?php

require "../sqlHelper.php";

session_start();

// to get phone number from secsion of previous page

$phoneNum=$_SESSION['phoneNum'];

$sqlHelper=new sqlHelper();
//to check if the userName is already taken by other members
$sql="select * from customer_table2 where phone='".$phoneNum."'";
file_put_contents('log.txt',"going to check if phone number already exists in member table".PHP_EOL, FILE_APPEND);
$res=$sqlHelper->execute_dql($sql);
if($res->num_rows!==0){
    //phone number already register as existing Customer
    $newCust=false;
    $_SESSION['newCust'] = $newCust;
    
    echo "<script> if(confirm( 'You are an existing CUSTOMER. Would you like to regiester as a MEMBER now? '))  location.href='memRegisterForm.php';else location.href='login.php'; </script>";
    
}
else{
    //phone number not exists, go to customer register
    $newCust=true;
    $_SESSION['newCust'] = $newCust;
    echo "<script> if(confirm( 'You are Not an existing CUSTOMER. To view the member page, you need to register as a customer first. Would you like to regiester as a Customer now? '))  location.href='registerForm.php';else location.href='login.php'; </script>";
}
?>