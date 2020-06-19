<?php

require "../sqlHelper.php";

session_start();

// to get form data
// $userName=$_SESSION['userName'];
// $password=$_SESSION['password'];
$firstName=$_SESSION['firstName'];
$lastName=$_SESSION['lastName'];
$address=$_SESSION['address'];
$phoneNum=$_SESSION['phoneNum'];
$email=$_SESSION['email'];

file_put_contents('log.txt',"in custReg Page now".PHP_EOL, FILE_APPEND);
//store userName for use in MEMBER regester 

$sqlHelper=new sqlHelper();
//to check if the phone is already taken by other customers
$sql="select * from customer_table2 where phone='".$phoneNum."'";
file_put_contents('log.txt',"going to check if phone already exists in customer table".PHP_EOL, FILE_APPEND);
$res=$sqlHelper->execute_dql($sql);
if($res->num_rows!==0){
    //phone already taken
    echo "<script language='javascript'>alert('The Phone Number is already taken by others. Please choose another name to retry');</script>";
//     echo "<script language='javascript'>window.history.go(-1);</script>";
    echo '<script language="javascript">window.location.replace("registerForm.php");</script>';
    
  
}
else{

    $sql="select max(custid) from customer_table2";
    $res=$sqlHelper->execute_dql($sql);
 
    while($row=mysqli_fetch_row($res)){
        foreach($row as $key=> $val){
            echo "hi";
            echo "---$val";
            $maxId=$val;
            $nextId=$maxId+1;
            $_SESSION['nextId']=$nextId;
        }
        echo "</br>"  ;
    }   
    

// $sql="insert into customer_table2 (custid, userid, password, firstname, secondname, address, phone, email, flag) values('$nextId','$userName','$password','$firstName','$lastName','$address','$phoneNum','$email','N')";
$sql="insert into customer_table2 (custid, firstname, secondname, address, phone, email, flag) values('$nextId','$firstName','$lastName','$address','$phoneNum','$email','N')";
file_put_contents('log.txt',"sql=".$sql.PHP_EOL, FILE_APPEND);
file_put_contents('log.txt',"going to insert cust_table".PHP_EOL, FILE_APPEND);
file_put_contents('log.txt',"nextID=".$nextId.PHP_EOL, FILE_APPEND);
$res=$sqlHelper->execute_dml($sql);
if($res==0){
    echo "<script language='javascript'>alert('failed in customer table insertion, going back to the previous page');</script>";
//     echo "<script language='javascript'>window.history.go(-1);</script>";
    echo '<script type="text/javascript">window.location.replace("registerForm.php");</script>';
}
else {
    if($res==1){
        echo "<script> if(confirm( 'Congratulations.You have been registered as a CUSTOMER now. Would you like to regiester as a MEMBER now? '))  
location.href='memRegisterForm.php';else location.href='login.php'; </script>"; 
//         echo "<script language='javascript'>window.location.href='memberReg.php';</script>";
//             exit();
    }
    else{
        echo "no records are affected";
    }
}
}
?>