<?php

    session_start();

    $user = 'root';
    $pass = '';
    $db = 'test_1';
    
    $db = new mysqli('localhost',$user, $pass, $db) or die("Failed to connect");

    // define variables and set to empty values
    global $FirstName,$LastName,$Address1,$Address2,$City,$State,$Zip;
    

    // Validate Variables After User Submits Form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UserName = $_SESSION['username'];
        $FirstName = test_input($_POST["FirstName"]);
        $LastName = test_input($_POST["LastName"]);
        $Address1 = test_input($_POST["Address1"]);
        $Address2 = test_input($_POST["Address2"]);
        $City = test_input($_POST["City"]);
        $State = test_input($_POST["State"]);
        $Zip = test_input($_POST["ZipCode"]);

        postUser($UserName,$FirstName,$LastName,$Address1,$Address2,$City,$State,$Zip,$db);
      }
      
      // Clean the input incase of Sql Injection
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // Method Updates The Company Information In The DB When User Submits
      function postUser($UserName,$FirstName,$LastName,$Address1,$Address2,$City,$State,$Zip,$db)
      {
        $query = "UPDATE users SET firstname = '$FirstName',lastname='$LastName', address1='$Address1', address2='$Address2',city='$City',state='$State',zip='$Zip' WHERE username='$UserName'";
        mysqli_query($db, $query);

        // Save Fields Across Program
        $_SESSION['Address1'] = $Address1;
        $_SESSION['State'] = $State;

        // On Successful submission Take User Back To Fuel Quote Page
         header('location: fuelQuote.php');
      }


?> 


<!DOCTYPE html>

<html>

<head>

<title>Update your account</title>
<link rel="stylesheet" href="clientProfMan.CSS" />
</head>
<body>

<h1 align="left"style = "color:green;">Complete Your Account</h1>

<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
            <p>Please fill in this form to update your account.</p>
                <hr>
            
                    <label for="FirstName"><b>First Name*</b></label>
                    <input type="text" placeholder="Enter FirstName" name="FirstName" maxlength="50" required>
                
                
                    <label for="Last Name"><b>Last Name*</b></label>
                    <input type="text" placeholder="Enter Last Name" name="LastName" maxlength="50" required>
                
                
                    <label for="Address 1"><b>Address 1*</b></label>
                    <input type="text" placeholder="Enter Address 1" name="Address1" maxlength="100" required>
                
                
                    <label for="Address 2"><b>Address 2</b></label>
                    <input type="text" placeholder="Enter Address 2" maxlength="100" name="Address2">
                
                
                    <label for="City"><b>City*</b></label>
                    <input type="text" placeholder="City" name="City" maxlength="100" required>
                    
                    <label for="State"><b>State*</b></label>
                    <select name = "State">
                        <option value="AL">AL</option>
                        <option value="AK">AK</option>
                        <option value="AR">AR</option>	
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>	
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>	
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>	
                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>			
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="ND">ND</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VT">VT</option>
                        <option value="VA">VA</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>	
                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                    </select>
                    <br>
                    <br>
                    <label for="ZipCode"><b>ZipCode*</b></label>
                    <input type="text" placeholder="ZipCode" name="ZipCode" minlength="5" maxlength="9" required>
                <hr>

                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit" class="registerbtn">Update User</button>
        </div>

  <div class="container signin">
    <p>Already have an account? <a href="Login.php">Sign in</a>.</p>
  </div>

</form>
</body>
</html>
