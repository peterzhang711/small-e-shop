<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
body,h1,ul{
    font-family: Arial, Helvetica, sans-serif;
    margin:0;
    padding: 0;
}
ul{
   list-style: outside none none;
}
a {
    text-decoration: none;
}
.none{
    display: none;
}
#search{
    width: 100%;
    min-width: 163px;
    height: 140px;
    background: url("../images/logo.jpg") no-repeat center;
/*     margin-left:-500px; */
}

#text {
    width: 1263px;
    padding-left: 20px;
    margin: 0 auto;
    margin-bottom: 20px;
}
#text p {
    font-size: 20px;
    color:darkgrey;
    line-height: 1.6;
}
#text .dot li{
    font-size: 20px;
    color: darkgrey;
}

#test{
margin-left:50px; 
margin-bottom:100px;
} 
p {
	font-family: "Times New Roman", Times, serif;
	font-size: 18px;
	font-weight: bold;
}
.error {color: #FF0000;}

<?php include '../CSS/include/header_css.inc'; ?>
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
<!-- <link rel="stylesheet" href="../css/style.css"> -->
</head>
<body>
<?php

file_put_contents('log.txt',"Hello1 world everyone.".date("h:i:sa").PHP_EOL);
// session_start();
// session_destroy();

$userNameVal=null;
$passwordVal=null;

$userName=$password=$userNameErr=$passwordErr="";
//to exclude '/.%\@?' sign in user name
$reUserName="/^[^\/\.\%\\\@\?]+$/i";

//to ONLY allow 6 digit of number, letters, '.','/', from begining and the end of the string in password
$rePassword="/^[a-z0-9\.\/]{6,}$/i";

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
    file_put_contents('log.txt',"id=".($_POST["userName"])."\r\n", FILE_APPEND);
    
    if (empty($_POST["userName"])) {
        $userNameErr = "userName must not be empty";
        $userNameVal=false;
    } else {
        $userName = test_input($_POST["userName"]);
        // 检查姓名是否包含字母和空白字符
        //chech whether the username 
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
}
?>
<header id="header">
    <div class="center">
<!--         <h1 class="logo">Bazaar Ceramic</h1> -->
        <nav class="link" >
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li class="dropdown"><a href="About_Us.php" >About Us+</a>
                    <div  class="ddc">
                        <a href="company_bg.php">History</a>
                        <!--<a href="html/design.php">Design</a>-->
                        <a href="process.php">Process</a>
                        <a href="company_mission.php">Mission</a>
                    </div>
                </li>
                <li class="dropdown"><a href="Collections.php">Collections</a>
                    <div class="ddc">
                        <a href="members.php">Members</a>
                    </div>
                </li>
                <li><a href="Forms.php">Forms</a></li>
                <li><a href="Contact_Us.php">Contact Us</a></li>
            </ul>
        </nav>
        </div>
     </header>
<div id="search">
</div>
<div id="test">
<p>Please either log in or register as a Member to view the member pages.</p>
<span class="error">* must not be empty</span>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table>
	<tr><td>ID:       </td><td><input type="text"     name="userName"  value="<?php echo $userName;?>"></td><td><span class="error">* <?php echo $userNameErr;?></span></td></tr>
	<tr><td>Password: </td><td><input type="password" name="password"  value="<?php echo $password;?>"></td><td><span class="error">* <?php echo $passwordErr;?></span></td></tr>
	<tr><td><input type="submit" value="login" name="submit" id="btn1"></td></tr>
	<tr></tr>

	</table>
</form> 
<a href="phoneCheck.php" target="blank"><input type="submit" value="Register as a Member"></a>
<a href="../index.php"><input type="submit" value="Cancel"></a>
</div>
<?php 

if (!empty($_GET['errno'])){
    $errno=$_GET['errno'];
    if ($errno==1)
    {
        echo "<br/><font color='red' size='3'>User name or password not match</font>";
    }
    else if($errno==2){
        echo "<br/><font color='red' size='3'>Please login to view the pages</font>";
    }
    else if($errno==3){
        echo "<br/><font color='red' size='3'>Please register as a Member before login</font>";
    }
}

if ($userNameVal==true & $passwordVal==true)
        {
            
            file_put_contents('log.txt',"resubmit userName again".PHP_EOL, FILE_APPEND);
         
            $_SESSION['logId'] = $userName;
            $_SESSION['logPassword'] = $password; 
            file_put_contents('log.txt'," resubmit userName=".$_SESSION['logId'].PHP_EOL, FILE_APPEND);
            header("Location: loginProcess.php");
        }
        
?>
<?php include 'include/footer.inc'?>
</body>

</html>