<?php  
require_once 'C:\xampp\htdocs\Lab6\model/model.php';


if (isset($_POST['createUser'])) {
	$data['username'] = $_POST['username'];
	$data['email'] = $_POST['email'];

	$data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 6]);

	$data['gender'] = $_POST['gender'];






  }
  else 
  {
    echo "Sorry, there was an error uploading your file.";
  }

  if (addUser($data)) 
  {
  	echo 'Successfully added!!';
  }
else 
{
	echo 'You are not allowed to access this page.';
}

?>