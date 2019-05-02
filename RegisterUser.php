<!DOCTYPE html>
<html>
<head>
<title>Register User</title>
<link rel = "stylesheet" href="clientProfMan.css"/>
</head>

<body>
<h1 align="left"style = "color:green;"> Register New User</h1>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
            <p>Sign Up Here</p>
                <hr>
                    <label for="UserName"><b>New UserName*</b></label>
                    <input type="text" placeholder="Enter New UserName" name="newUserName" maxlength="50" required>
                
                    <label for="Password"><b>New Password</b></label>
                    <input type="text" placeholder="Enter New Password" name="newPassword" maxlength="50" required>
                <hr>

                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit" class="registerbtn">Register</button>
        </div>

  <div class="container signin">
    <p>Return To Login Page <a href="Login.php">Return</a>.</p>
  </div>

</form>
<?php
    $user = 'root';
    $pass = '';
    $db = 'test_1';
    
    $db = new mysqli('localhost',$user, $pass, $db) or die("Failed to connect");

    // Define User Input Variables
    $newUsername = "";
    $newPassword = "";

    // Validate and assign values to variables
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newUsername = test_input($_POST["newUserName"]);
        $newPassword = test_input($_POST["newPassword"]);

        registerUser($newUsername, $newPassword,$db);
        
      }
      
    // Clean Variables   
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Register The User In The DB If That Username Does Not Already Exist
    function registerUser($newUsername, $newPassword,$db)
    {
        $user_check_query = "SELECT * FROM users WHERE username='$newUsername' OR password='$newPassword' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if ($user) 
        { 
          echo "Username Already Taken!";
        }
        else
        {
            $query = "INSERT INTO users (username, password) 
                      VALUES('$newUsername', '$newPassword')";
            mysqli_query($db, $query);
          
            // On Successful Submission Send USer To Login Page
            header('location: Login.php');
        }
    }
?> 

</body>
</html>