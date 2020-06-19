<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
<script>
window.onload=function ()
{
   var userName=document.getElementById('userName');
   var password=document.getElementById('password');
   var phoneNum=document.getElementById('phoneNum');
   var email=document.getElementById('email');
   
   var oBtn=document.getElementById('btn1');
//    oBtn.onclick=function ()   
   }
   
   function sub_Ord()
   {
	 	//to exclude '/.%\@?' sign in user name 	
    	var reUserName=/^[^\/\.\%\\\@\?]+$/i;
       //to ONLY allow 6 digit of number, letters, '.','/', from begining and the end of the string in password
    	var rePassword=/^[a-z0-9\.\/]{6,}$/i;
       	//to allow int only in phone number
    	var rePhone=/^[0-9]+$/;
       	//to include @ in email address     
    	var reEmail=/^\w+@[0-9a-z]+\.[a-z0-9]+$/i;        	

       	//userName validation
        if(reUserName.test(userName.value))
        {
        	alert('valid userName');
        	
        }
        else
        {
        	alert('not valid userName');
        	
        }

    	//password validation
        if(rePassword.test(password.value))
        {
        	alert('valid password');
        	
        }
        else
        {
        	alert('not valid password');
        	
        }
    	//phone number validation
        if(rePhone.test(phoneNum.value))
        {
        	alert('valid phoneNum');
        	
        }
        else
        {
        	alert('not valid phoneNum');
      
        }

    	//email validation
        if(reEmail.test(email.value))
        {
        	alert('valid email');
        }
        else
        {
        	alert('not valid email');
        }
        //return true/false and for onsubmit function
        if( (reUserName.test(userName.value))&& (rePassword.test(password.value))&&(rePhone.test(phoneNum.value))&&(reEmail.test(email.value)) )
            {
        	return true;
            }
        else{
        	return false;
            }
	}
</script>

</head>
<body>
	<?php
	
	session_start();
	//############amend???????????????
// 	$firstName=$_SESSION['firstName'];
// 	$lastName=$_SESSION['lastName'];
// 	$address=$_SESSION['address'];
// 	$phoneNum=$_SESSION['phoneNum'];
// 	$email=$_SESSION['email'];
	
	//to exclude '/.%\@?' sign in user name
	$reUserName="/^[^\/\.\%\\\@\?]+$/i";
	
	//to ONLY allow 6 digit of number, letters, '.','/', from begining and the end of the string in password
	$rePassword="/^[a-z0-9\.\/]{6,}$/i";
	
	//to allow int only in phone number
	$rePhone="/^[0-9]+$/";
	
	//to include @ in email address
	$reEmail="/^\w+@[0-9a-z]+\.[a-z0-9]+$/i";
	
	$userNameVal=null;
	$passwordVal=null;
	$firstNameVal=null;
	$lastNameVal=null;
	$addressVal=null;
	$phoneNumVal=null;
	$emailVal=null;
	
	function test_input($data) {
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
	
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    
	    $firstName = test_input($_POST["firstName"]);
	    $lastName = test_input($_POST["lastName"]);
	    $address = test_input($_POST["address"]);
	    $phone = test_input($_POST["phoneNum"]);
	    $email = test_input($_POST["email"]);
	    
	    
	    if (empty($_POST["firstName"])) {
	        $firstNameErr = "firstName must not be empty";
	        $firstNameVal=false;
	    } else {
	        $firstName = test_input($_POST["firstName"]);
	        $firstNameVal=true;
	        // 检查姓名是否包含字母和空白字符
	    }
	    
	    if (empty($_POST["lastName"])) {
	        $lastNameErr = "lastName must not be empty";
	        $lastNameVal=false;
	    } else {
	        $lastName = test_input($_POST["lastName"]);
	        $lastNameVal=true;
	        // 检查姓名是否包含字母和空白字符
	    }
	    
	    if (empty($_POST["phoneNum"])) {
	        $phoneNumErr = "phoneNum must not be empty";
	        $phoneNumVal=false;
	    } else {
	        $phoneNum = test_input($_POST["phoneNum"]);
	        // 检查姓名是否包含字母和空白字符
	        if (!preg_match($rePhone,$phoneNum)) {
	            $phoneNumErr = "phoneNum must allow int only in phone number";
	            $phoneNumVal=false;
	        }
	        else {
	            $phoneNumVal=true;
	        }
	    }
	    
	    
	    if (empty($_POST["address"])) {
	        $addressErr = "address must not be empty";
	        $addressVal=false;
	    } else {
	        $address = test_input($_POST["address"]);
	        // 检查姓名是否包含字母和空白字符
	        $addressVal=true;
	    }
	    
	    
	    if (!empty($_POST["email"])) {
	        $email = test_input($_POST["email"]);
	        // 检查姓名是否包含字母和空白字符
	        if (!preg_match($reEmail,$email)) {
	            $emailErr = "email must include @ in email address";
	            $emailVal=false;
	            
	        }else {
	            $email = test_input($_POST["email"]);
	            // 检查姓名是否包含字母和空白字符
	            $emailVal=true;
	        
	    }
	    
	    }
	    }
	?>
	<!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
	<form method="post" action="http://localhost/Bazaar_Ceramics_ss/html/registerForm.php">  
	New Customer Registration Form<br><br>
	<span class="error">* must not be empty</span>
	<table>
	
	<tr><td>First Name:   	</td><td><input type="text" name="firstName" value="<?php echo $firstName;?>"></td><td><span class="error">* <?php echo $firstNameErr;?></span></td></tr>
	<tr><td>Last Name:    	</td><td><input type="text" name="lastName" value="<?php echo $lastName;?>"></td><td><span class="error">* <?php echo $lastNameErr;?></span></td></tr>
	<tr><td>Address:     	</td><td><input type="text" name="address" value="<?php echo $address;?>"></td><td><span class="error">* <?php echo $addressErr;?></span></td></tr>
	<tr><td>Phone Number: 	</td><td><input type="text" name="phoneNum" id="phoneNum" value="<?php echo $phoneNum;?>"></td><td><span class="error">* <?php echo $phoneNumErr;?></span></td></tr>
	<tr><td>Email:       	</td><td><input type="email" name="email" id="email" value="<?php echo $email;?>"></td><td><span class="error"><?php echo $emailErr;?></span></td></tr>
	</table>
	<br>
	<table>
<tr>
	<td><input type="submit" value="Register as Customer" name="submit" id="btn1"></td>
	<td><input type="reset" value="Reset" name="reset" id="btn2"></td>
	<td><input type="button" name="cancel" value="Cancel" onClick="window.close()"/></td>
</tr>
	</table>

	
	</form>

<?php 
        
        if ($firstNameVal==true & $lastNameVal==true & $addressVal==true & $phoneNumVal==true & (!$emailVal=false))
        {
            
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['address'] = $address;
            $_SESSION['phoneNum'] = $phoneNum;
            $_SESSION['email'] = $email;
            
            header("Location: custRegister.php");
        }
        
   
?>
</body>
</html>