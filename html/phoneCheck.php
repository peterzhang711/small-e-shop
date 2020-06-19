<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>

<?php
	
	session_start();
	$phoneNum=$phoneNumErr="";
	$phoneNum=$_POST['phoneNum'];
	
	//to allow int only in phone number
	$rePhone="/^[0-9]+$/";
	
	$phoneNumVal=null;
	
	function test_input($data) {
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    $phone = test_input($_POST["phoneNum"]);
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
	    
	}
	
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<p>Please enter your phone number to check whether you are are an existing customer</p>
<span class="error">* must not be empty</span>
	<table>
	<tr><td>phone number:  </td><td><input type="text" name="phoneNum" value="<?php echo $phoneNum;?>"/></td><td><span class="error">* <?php echo $phoneNumErr;?></span></td></tr>
	<tr></tr>
	<tr><td><input type="submit" value="Check"></td><td><input type="button" name="cancel" value="Cancel" onClick="window.close()"/></td></tr>

	</table>
</form>

<?php 

        
        
        if ($phoneNumVal==true )
        {
          
            $_SESSION['phoneNum'] = $phoneNum;
            
      
            header("Location: custCheck.php");
        }
        
   
?>
</body>

</html>
