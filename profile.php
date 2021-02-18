<?php
if (isset($_POST['submit'])){
	$image=$_POST["image"];
	//$image = isset($_GET['image']) ? $_GET['image'] : '';
	$type=Array(1 => 'jpg', 2 => 'jpeg', 3 => 'png');
	 $ext = explode(".",$image); //explode and find value after dot
     
	if(!(in_array($ext[1],$type))) //check image extension not in the array $type
	{
       echo " Picture format must be in jpeg or jpg or png!..";
	   
	}else
	{
		echo "image upload successful!!..";
	}
}
?>

<html>
<head>
<title>profile</title>
</head>
<body align="center">

 <form method="post">
  <div class="container">
  
    <br/><br/><br/><h2 class="success">Welcome Admin!!</h2>
	<img id="preimage" width="300px" height="300px" alt=" "></br>
	<input type="file" id="image" name="image" onchange="loadfile(event)"><br/>
     <input type="submit" value="submit" name="submit">
	<script type="text/javascript">                                     
	function loadfile(event){
		var output=document.getElementById('preimage');
		output.src=URL.createObjectURL(event.target.files[0]);
	}
	
	</script>
	</form>
	
	



</body>
</html>           