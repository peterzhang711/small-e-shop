<!DOCTYPE html>
<html>
<head>
<style>
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
<script>
</script>
</head>
<body>
<?php

file_put_contents('log.txt',"in logout page"."\r\n", FILE_APPEND);
session_unset();
session_destroy();
setcookie('loginUser','',0,'/','localhost');
?>
</body>
</html>