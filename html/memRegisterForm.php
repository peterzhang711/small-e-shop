<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
<script>
</script>

</head>
<body>
<?php 
    header('Cache-control:private,must-revalidate');
?>

<?php
	
	file_put_contents('log.txt',"member Register Form page".PHP_EOL, FILE_APPEND);
	
	header("Cache-control: private");
	session_start();
	
	//amended##########
// 	$userName=$_SESSION['userName'];
// 	$password=$_SESSION['password'];
	file_put_contents('log.txt',"userName in secssion=".$_SESSION['userName']."\r\n", FILE_APPEND);
	
	//to exclude '/.%\@?' sign in user name
	$reUserName="/^[^\/\.\%\\\@\?]+$/i";
	
	//to ONLY allow 6 digit of number, letters, '.','/', from begining and the end of the string in password
	$rePassword="/^[a-z0-9\.\/]{6,}$/i";
	
	$userNameVal=null;
	$passwordVal=null;
	
	function test_input($data) {
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
	
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    
	    //only when the button is pressed, it's POST, or it won't come into the POST condition
	    $userName = test_input($_POST["userName"]);
	    $password = test_input($_POST["password"]);
	    file_put_contents('log.txt',"userName is post=".$userName."\r\n", FILE_APPEND);
	    
	    if (empty($_POST["userName"])) {
	        $userNameErr = "userName must not be empty";
	        $userNameVal=false;
	    } else {
	        $userName = test_input($_POST["userName"]);
	        // 检查姓名是否包含字母和空白字符
	        if (!preg_match($reUserName,$userName)) {
	            $userNameErr = "userName must exclude '/.%\@?' sign in user name";
	            $userNameVal=false;
	        }
	        else {
	            $userNameVal=true;
	        }
	    }
	   
	    
	    if (empty($_POST["password"])) {
	        $passwordErr = "password must not be empty";
	        $passwordVal=false;
	    } else {
	        $password = test_input($_POST["password"]);
	        // 检查姓名是否包含字母和空白字符
	        if (!preg_match($rePassword,$password)) {
	            $passwordErr = "password must ONLY allow 6 digit of number, letters, '.','/', from begining and the end of the string in password";
	            $passwordVal=false;
	        }
	        else {
	            $passwordVal=true;
	        }
	    }
	    file_put_contents('log.txt',"
".PHP_EOL, FILE_APPEND);
	    }
	?>
	 <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
	
	<form method="post" action="http://localhost/Bazaar_Ceramics_ss/html/memRegisterForm.php"> 
	New Member Registration Form<br><br>
	<span class="error">* must not be empty</span>
	<table>
	
	<tr><td>User Name:  	</td><td><input type="text" name="userName" id="userName" value="<?php echo $userName;?>"></td><td><span class="error">* <?php echo $userNameErr;?></span></td></tr>
	<tr><td>Password:  		</td><td><input type="text" name="password" id="password" value="<?php echo $password;?>"></td><td><span class="error">* <?php echo $passwordErr;?></span></td></tr>
	
	</table>
	<br>
	<input type="submit" value="Register as Member" name="submit" id="btn1">
	<table>
	<tr>
	<td><input type="reset" value="Reset" name="reset" id="btn2"></td>
	<td><input type="button" name="cancel" value="Cancel" onClick="window.close()"/></td>
	</tr>
	</table>
	</form>

<?php 
    file_put_contents('log.txt',"stay at bottom of memRegister Page###".PHP_EOL, FILE_APPEND);
    file_put_contents('log.txt'," userNameVal=".$userNameVal.PHP_EOL, FILE_APPEND);
    file_put_contents('log.txt'," passwordVal=".$passwordVal.PHP_EOL, FILE_APPEND);
        if ($userNameVal==true & $passwordVal==true)
        {
            $_SESSION['userName'] = $userName;
            $_SESSION['password'] = $password;
            
            $_SESSION['userNameVal'] = $userNameVal;
            $_SESSION['passwordVal'] = $passwordVal;
            
            file_put_contents('log.txt'," resubmit userName=".$userName.PHP_EOL, FILE_APPEND);
            file_put_contents('log.txt',"resubmit userName again".PHP_EOL, FILE_APPEND);
//             file_put_contents('log.txt',"hi firstName=".$firstName.PHP_EOL, FILE_APPEND);
         
            header("Location: memberReg.php");
        }
        
   
?>
</body>
</html>