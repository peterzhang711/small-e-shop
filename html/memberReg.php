<?php
require "../sqlHelper.php";

header('Cache-control:private,must-revalidate');
session_start();

$id = $_SESSION['id'];
file_put_contents('log.txt',"in memberReg page now".PHP_EOL,FILE_APPEND);


$password = $_SESSION['password'];
file_put_contents('log.txt',"password=".$_SESSION['password']."\r\n", FILE_APPEND);


$userName = $_SESSION['userName'];
$nextId=$_SESSION['nextId'];

file_put_contents('log.txt',"userName=".$userName."\r\n", FILE_APPEND);
$newCust=$_SESSION['newCust'];
$phoneNum=$_SESSION['phoneNum'];

$nextId=$_SESSION['nextId'];

$sqlHelper=new sqlHelper();
// to check if the userName is already taken by other members
file_put_contents('log.txt',"going to check if userName already exists in member table".PHP_EOL, FILE_APPEND);
$sql="select * from member_table2 where user_id='".$userName."'";
file_put_contents('log.txt',"sql=".$sql.PHP_EOL, FILE_APPEND);

$res=$sqlHelper->execute_dql($sql);
if($res->num_rows!==0){
    //name already taken
    file_put_contents('log.txt',"name already exist".PHP_EOL, FILE_APPEND);
    echo "<script language='javascript'>alert('The User Name is already taken by others. Please choose another name to retry');</script>";
//     echo "<script language='javascript'>window.history.go(-1);</script>";
    echo '<script type="text/javascript">window.location.replace("memRegisterForm.php");</script>';
}
else{
    
    
//username does not exist in member table yet
    file_put_contents('log.txt',"name Not exist in member table".PHP_EOL, FILE_APPEND);
// $sqlHelper=new sqlHelper();
//note: must use $userName as column name in this insert SQL, as the customer might have changed the userName in the cust register form, 
//it might be different from the login screen
    $saltKey='$2a$10$usesomesillystringfors$';
    $pass = urlencode($password);
    $pass_crypt = crypt($pass,$saltKey);
    if ($newCust){
        file_put_contents('log.txt',"new cust register in member table".PHP_EOL, FILE_APPEND);
        file_put_contents('log.txt',"new cust".PHP_EOL, FILE_APPEND);
//         $sql="insert into member_table2 (customer_id,user_id,password) values ($nextId,'$userName','$password')";
        $sql="insert into member_table2 (customer_id,user_id,password) values ($nextId,'$userName','$pass_crypt')";
        file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
    }
    else{
        //get existing custId from customer table
        file_put_contents('log.txt',"existing cust".PHP_EOL, FILE_APPEND);
        $sql="select * from customer_table2 where phone='".$phoneNum."'";
        file_put_contents('log.txt',"sql inside=".$sql."\r\n", FILE_APPEND);
        $res=$sqlHelper->execute_dql($sql);
        if($res->num_rows!==0){
            //can locate custId from cust table by phone number
            $row=$res->fetch_row();
            $row[0];
        
            //store existing custid from cust table
            $_SESSION['custIdExistCust'] = $row[0];
            $newCust=false;
            $_SESSION['newCust'] = $newCust;
        
            file_put_contents('log.txt',"row[0]=".$row[0]."\r\n", FILE_APPEND);
    
            file_put_contents('log.txt',"exist cust".PHP_EOL, FILE_APPEND);
            $existCustId=$_SESSION['custIdExistCust'];
//             $sql="insert into member_table2 (customer_id,user_id,password) values ($existCustId,'$userName','$password')";
            $sql="insert into member_table2 (customer_id,user_id,password) values ($existCustId,'$userName','$pass_crypt')";
        }
    }
    
    file_put_contents('log.txt',"sql outside=".$sql."\r\n", FILE_APPEND);
    file_put_contents('log.txt',"nextId=".$nextId."\r\n", FILE_APPEND);
    file_put_contents('log.txt',"going to insert MEMBER_table".PHP_EOL, FILE_APPEND);
        
    $res=$sqlHelper->execute_dml($sql);
        if($res==0){
            echo "failed in insert member table";
            file_put_contents('log.txt',"failed in insert member table".PHP_EOL, FILE_APPEND);
            header("Location: ../index.php");
        }
        else {
            if($res==1){
                //insert to member table successfully
                //*********** pending ******************* need to set flag to 'Y' in customer table as well.
                if ($newCust){
                    $sql="update customer_table2 set flag='Y' where custid= '$nextId'";
                }
                else{
                    $existCustId=$_SESSION['custIdExistCust'];
                    $sql="update customer_table2 set flag='Y' where custid= '$existCustId'";
                }
                file_put_contents('log.txt',"going to update CUST_table".PHP_EOL, FILE_APPEND);
                file_put_contents('log.txt',"sql=".$sql.PHP_EOL, FILE_APPEND);
               
                $res=$sqlHelper->execute_dml($sql);
                if($res==0){
                    echo "failed in setting up Member flag as an existing customer";
                    file_put_contents('log.txt',"failed in setting up Member flag as an existing customer".PHP_EOL, FILE_APPEND);
                    header("Location: ../index.php");
                }
                else {
                    if($res==1){
                    echo "congrages, successful";
                    echo "<script language='javascript'>alert('Congratulations.You have been registered as a member now. Redirecting to the member login page.');</script>";
                    echo "<script language='javascript'>window.location.href='members.php';</script>";
                    }
                else{
                    echo "no records are affected, failed in setting up Member flag as an existing customer";
                    }
                }   
            }
            else{
                echo "no records are affected in member table";
            }
        }
        
    }


?>