<?php
require "../sqlHelper.php";
session_set_cookie_params(1800 , '/', '.localhost');
session_start();

echo "<script>console.log('hahahahah')</script>";

// to get login Data$_POST['userName']
$logId=$_SESSION['logId'];
$logPassword=$_SESSION['logPassword'];

file_put_contents('log.txt',"logId=".$logId."\r\n", FILE_APPEND);
file_put_contents('log.txt',"logPassword=".$logPassword."\r\n", FILE_APPEND);
$newCust=null;

$sqlHelper=new sqlHelper();
file_put_contents('log.txt',"in login process page".PHP_EOL, FILE_APPEND);
$sql="select * from member_table2 where user_id='".$logId."'";

file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
// coding to use dql for query
$res=$sqlHelper->execute_dql($sql);

if($res->num_rows!==0){
    //user name exists in member table
    echo "test come here";
    while($row=$res->fetch_row()){
        echo "here1?";
        echo "$row[2]";
        
        
       
            
//         if($logPassword==$row[2]){

        $saltKey='$2a$10$usesomesillystringfors$';
        //convert char type for website input
        $pass = urlencode($logPassword);
        //manual input encrpyt by salt
        $pass_crypt = crypt($pass,$saltKey);
        //$row[2] is the encrypted password saved in DB, crypt($pass,$saltKey) is the manual input one converted by blowfish
        if ($row[2] == crypt($pass, $pass_crypt)){
            
            
            //password also match
            file_put_contents('log.txt',"user Name Exist in member table".PHP_EOL, FILE_APPEND);
            //store userName for welcome message display
            $_SESSION['userName'] = $row[1];
            //password match in member table, go to member page
            $newCust=false;
            $_SESSION['newCust'] = $newCust;
            $_SESSION['loginUser'] =$row[1];
            
//             ini_set('session.cookie_path', '/');
//             ini_set('session.cookie_domain', 'localhost');
//             ini_set('session.cookie_lifetime', '1800');          
           
            file_put_contents('log.txt',"login user cookie in loginprocess page=".$_COOKIE["loginUser"]."\r\n", FILE_APPEND);
            
            $custId=$row[0];
            
            //further, to get first name for welcome message
            $sql="select * from customer_table2 where custid='".$custId."'";
            file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
            // coding to use dql for query
            $res=$sqlHelper->execute_dql($sql);
            if($res->num_rows!==0){
                echo "test come here";
                while($row=$res->fetch_row()){
                    file_put_contents('log.txt',"firstName=".$row[1]."\r\n", FILE_APPEND);
                    $_SESSION['firstName'] =$row[1];
                    $_SESSION['custid'] =$row[0];
                    file_put_contents('log.txt',"custid in login process page=".$row[0]."\r\n", FILE_APPEND);
                    //store first name in cookie for welcome message
                    setcookie('loginUser',$row[1],0,'/','localhost');
                }
            }
            
            
            $res->free();
            //store session for greetinig message and security check
            file_put_contents('log.txt',"session before=".($_SESSION['loginUser'])."\r\n", FILE_APPEND);
            
            
            header("Location: members.php");
            exit();
        }
        else{
            //password not match, go back to login again, will show error message
            file_put_contents('log.txt',"password not match in member table".PHP_EOL, FILE_APPEND);
            echo "here2?";
            $_SESSION['newCust'] = $newCust;
            
            $res->free();
            $errCode=1;
            header("Location: login.php?errno=1");
            exit();
        } 
    }
    echo "here 3";
 
}
else
//user name not exist in member table
{file_put_contents('log.txt',"user Name NOT Exist in member table".PHP_EOL, FILE_APPEND);
$res->free();
$errCode=3;
header("Location: login.php?errno=3");
exit();
    
}

?>