<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  Name:<fieldset>
  <form form action-"/action_page.php"> 
    <fieldset>
      <legend>Name</legend>
      <label for="fname"></label><br>
      <input type="text" id="fname" name="fname" value="<?php echo $name;?>">
      <span class="error">* <?php echo $nameErr;?></span>
      <hr>
      <input type="submit" value="Submit">
    </fieldset>
    <br>
    <br>

    <form form action-"/action_page.php"> 
    <fieldset>
      <legend>Email</legend>
      <label for="fname"></label><br>
      <input type="text" id="fname" name="fname" value="<?php echo $emailErr;?>">
      <span class="error">* <?php echo $emailErr;?></span>
      <hr>
      <input type="submit" value="Submit">
    </fieldset>
    <br>
    <br>

    <form form action-"/action_page.php"> 
    <fieldset>
      <legend>Date of birth</legend>
      <label for="fname"></label><br>
      <input type="date" id="birthday" name="birthday" value="">
      <span class="error">* <? php echo $genderErr;?></span>
      <hr>
      <input type="submit" value="Submit">
      
</fieldset>
<br>
<br>


    <form form action-"/action_page.php"> 
    <fieldset>
      <legend>Gender</legend>
      <form>
  <input type="radio" id="male" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>value="male">
  <label for="male">Male</label>

  <input type="radio" id="female" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>value="female">
  <label for="female">Female</label>

  <input type="radio" id="other" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?>value="other">
  <label for="other">Other</label>
   <span class="error">* <?php echo $genderErr;?></span>
</form> 
      <hr>
      <input type="submit" value="Submit">
    </fieldset>
    <br>
    <br>

    <form form action-"/action_page.php"> 
    <fieldset>
      <legend>DEGREE</legend>
      <form action="/action_page.php">
  <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
  <label for="vehicle1"> SSC</label>
  <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> HSC</label>
  <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
  <label for="vehicle3"> BSc</label>
  
  <input type="checkbox" id="vehicle4" name="vehicle3" value="Boat">
  <label for="vehicle3"> Msc</label>
  

  
</form> 
      <hr>
      <input type="submit" value="Submit">
    </fieldset>
    <br>
  <br>

  <form form action-"/action_page.php"> 
    <fieldset>
      <legend>BLOOD GROUP</legend>

  <select id="blg" name="blg">
    <option value="b+">B+</option>
    <option value="b-">B-</option>
    <option value="a+">A+</option>
    <option value="a-">A-</option>
    <option value="ab+">AB+</option>
    <option value="ab-">AB-</option>
  </select>
 
</form>
      <hr>
      <input type="submit" value="Submit">
    </fieldset>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $date;
echo "<br>";

echo $gender;


?>

 

</body>
</html>