<!DOCTYPE html>

<html>
<head>
<meta name = "viewport" content = "width=device-width, initial-scale=1">

<title>Login</title>
<link rel="stylesheet" href="clientProfMan.CSS" />
</head>
<body>
<h1 align = "center" style="color:green;">Oil and Gas Ltd.</h1>
<img src="oil-rig-logo.png" alt="logo" style="width:400px; margin-left: 39.6%">

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
		<div class="container">
      <br>
      <br>
      <br>
      <br>
      <h2 align = "center" style="color:green;">Welcome to the login page</h2>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:300px; margin-left: 42.5%">Login</button>
    </div>
    <br>
</form>
<form action = "RegisterUser.php">
  <button type="submit" class="registerbtn" style="width:300px; margin-left: 42.5%">Sign Up</button>
</form>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action=" " method="post">
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" align = "center">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
  </form>

</div>

<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php

    session_start();

    // Initialize The DB Values
    $user = 'root';
    $pass = '';
    $db = 'test_1';
    
    // Set up DB connection
    $db = new mysqli('localhost',$user, $pass, $db) or die("Failed to connect");

    // define variables and set to empty values
    global $UserName,$Password;

    // Validate Variables On User Input
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $UserName = test_input($_POST["uname"]);
        $Password = test_input($_POST["psw"]);

        loginUser($UserName,$Password,$db);
    }
      
      // Pass Username and Password Through DB
      function test_input($data) 
      {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }

      // Method To Authorize UserName And Password
      function loginUser($UserName,$Password,$db)
      {
          // Query The DB with The User Input and Save Results
          $sql = "SELECT id FROM users WHERE username = '$UserName' and password = '$Password'";
          $result = mysqli_query($db,$sql);
      
          // If The Username Is Found send User to FuelQuote Page If not Let them know the credentials are invalid
          if (mysqli_num_rows($result) == 1)
          {
              $logged_in_user = mysqli_fetch_assoc($result);

              $_SESSION['user'] = $logged_in_user;
              $_SESSION['success']  = "You are now logged in";
              $_SESSION['username'] = $UserName;
              
              header('location: fuelQuote.php');
          }
          else
          {
              $error = "Your Login Name or Password is invalid";

              echo "Invalid Username and Password";

          }
      }
?> 
</body>
</html>
