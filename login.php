<?php
	
  
  if (isset($_POST['submit'])){
	  $username=$_POST["username"];
	  $password=$_POST["pass"];
	  $error="";
	  
	  if(strlen($username)<=2)
	  {
		  $error= "user name should be at least 2 character";
	  }
	   elseif(!preg_match("/^[A-Za-z0-9_]+$/",$username))
	  {
		  $error= "  user name can only be  alpha numeric characters, period, dash or underscore \n";
		  
	  }
	  elseif(strlen($password)<8)
	  {
		  $error= " \n password  should be at least 8 character";
	  }
	  elseif(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/",$password))
	  {
		  $error= " \n password must contain at least one of the special characters(@,#,$,%)";
	  }
	  else{
		  echo "successfull";
		 // header("Location: profile.php");
	  }
	  
	}
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible content="ie=edge">


<title>Login</title>
</head>
<body align="center">

<form action = "" method="post">
	<?php   
            if(isset($error))  
                {  
                    echo $error;  
                }  
    ?>  
    <br />  
  
    <label ><b>Username :</b></label>
	
    <input type="text" name="username" placeholder="Enter Username"  value="" required><br><br> 

    <label ><b>Password :</b></label>
	
    <input type="password" name="pass" placeholder="Enter Password"  value="" required><br><br> 

    
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
	</br>
	
	<div class="container" style="background-color:#f1f1f1">
    <input type="submit" value="submit" name="submit">
    <span class="pass"><a href="#">Forgot password?</a></span>
  </div>
	
 
</form>

</body>
</html>