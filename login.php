
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
$nameErr = $pwErr = "";
$name = $pw = "";
$in_post = 0;
print_r($_POST);

if (field("submit")) {
	$in_post = 1;
	$required_fields = ["name" => "Username",
		"pw" => "Password"];
	
	foreach ($required_fields as $f => $m){
		$v = field($f);
		$err_v = $f."Err";
		if (empty($v))
			$$err_v = "$m is required";
		else
			$$f = $v;
	}
	
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function field($name) {
	if (!array_key_exists($name, $_REQUEST))
		return null;
	
	return test_input($_REQUEST[$name]);
}
?>

<h2>Login form attempt</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Username: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="password" name="pw">
  <span class="error">* <?php echo $pwErr;?></span>
  <br><br>
  Agree: <input type="checkbox" name="agree">
  <br><br>
  <input type="submit" name="submit" value="Login">  
</form>


<?php
if ($in_post)
{
	echo "<h2>User:</h2>";
	echo $name;
	echo "<br>";
	echo $pw;
	echo "<br>";
	
	if (field("agree"))
		echo "Agreed :)";
	else 
		echo "User did not agree :(";
}

?>

</body>
</html>