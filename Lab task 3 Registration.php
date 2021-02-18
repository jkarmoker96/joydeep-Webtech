<?php  
 $message = '';  
 $error = '';  
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["name"]))  
      {  
           $error = "<label class='text-danger'>Enter Name</label>";  
      }  
	  else if(empty($_POST["email"]))  
      {  
           $error = "<label class='text-danger'>Enter email</label>";  
      }  
	  else if(empty($_POST["username"]))  
      {  
           $error = "<label class='text-danger'>Enter user name</label>";  
      }  
	  else if(empty($_POST["password"]))  
      {  
           $error = "<label class='text-danger'>Enter password</label>";  
      }  else if(empty($_POST["confirmpassword"]))  
      {  
           $error = "<label class='text-danger'>Enter confirmpassword</label>";  
      }  
      else if(empty($_POST["gender"]))  
      {  
           $error = "<label class='text-danger'>Enter Gender</label>";  
      }  
      
      else  
      {  
           if(file_exists('employee_data.json'))  
           {  
                $current_data = file_get_contents('employee_data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name'               =>     $_POST['name'],  
                     'email'          =>     $_POST["email"], 
					'username'          =>     $_POST["username"], 
					'password'          =>     $_POST["password"], 
                     'confirmpassword'     =>     $_POST["confirmpassword"],
					 'gender'			=>$_POST["gender"],
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('employee_data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      }  
 }  
 ?> 
 
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Assignment</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br/>  
           <div class="container" style="width:500px;">  
                <h3 align="">Store Data to JSON File</h3><br />                 
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                     <br />  
                     <label>Name</label>  
                     <input type="text" name="name" class="form-control" /><br />  
					 <label>Email</label>  
                     <input type="email" name="email" class="form-control" /><br />
					 <label>User Name</label>  
                     <input type="text" name="username" class="form-control" /><br />
					 <label>Password</label>  
                     <input type="password" name="password" class="form-control" /><br />
					 <label>Confirm Password</label>  
                     <input type="password" name="confirmpassword" class="form-control" /><br />
                     <label>Gender</label>  
					  <input type="radio" name="gender" value="female">Female
					  <input type="radio" name="gender" value="male">Male
					  <input type="radio" name="gender" value="other">Other
                     
                     <input type="submit" name="submit" value="Append" class="btn btn-info" /><br />                      
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>  
                </form>  
           </div>  
           <br />  
      </body>  
 </html> 