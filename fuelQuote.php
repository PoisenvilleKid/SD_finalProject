<?php


    session_start();

    // Set Up The DB Variables
    $user = 'root';
    $pass = '';
    $db = 'test_1';
    
    // Connect To DB
    $db = new mysqli('localhost',$user, $pass, $db) or die("Failed to connect");

    // define variables and set to empty values
    global $Gallons,$Date,$Price,$Total,$Discount,$Transportation,$Competitor,$Minimum;

    //Pre-Define Variables
    $Address1 = $_SESSION['Address1'];
    $UserName = $_SESSION['username'];

    // Define Values After User Submits Form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Variables With User Input
        $Gallons = test_input($_POST["Gallons"]);
        //$Address1 = test_input($_POST["Delivery"]);
        $Date = test_input($_POST["DeliveryDate"]);
        $SuggestedPrice = test_input($_POST["SuggestedPrice"]);
        $Total = test_input($_POST["Total"]);

        postQuote($UserName,$Gallons,$Address1,$Date,$SuggestedPrice,$Total,$db);
      }
      
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      // Method To Insert The Fuel Quote Form With All The Attributes To The DB
      function postQuote($UserName,$Gallons,$Address1,$Date,$SuggestedPrice,$Total,$db)
      {
          $query = "INSERT INTO history (username, gallons,address,date,price,total) 
                      VALUES('$UserName', '$Gallons','$Address1','$Date','$SuggestedPrice','$Total')";
            mysqli_query($db, $query);
            
            mysqli_close($db);
            //header('location: fuelHistory.php');
      }

?> 

<!DOCTYPE html>

<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<title>Fuel Quote</title>
<link rel="stylesheet" href="clientProfMan.CSS" />
</head>
<body>

<form method = "post" id="Quote" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="container">
		<h1 style = "color:green;">Fuel Quote Form</h1>
		<p style = "color:green;">Please Enter your Fuel Quote</p>
		<hr>
			<label for="Gallons Requested"><b>Gallons Requested</b></label>
			<input type="text"  id="Gallons" name="Gallons" required>

			<label for="Delivery"><b>Delivery Address</b></label>
			<input type="text"  id="Addy" name="Delivery" value="<?php echo $Address1; ?>"readonly>
			
			<label for="DeliveryDate"><b>Delivery Date:</b></label>
			<input type="date"  id = "date" name="DeliveryDate" required>
			<br>
			<br>

			<label for="SuggestedPrice"><b>Suggested Price</b></label>
			<input type="text"  id="SPrice" name="SuggestedPrice" readonly required>

			<label for="Total"><b>Total Amount Due</b></label>
			<input type="text"  id="TPrice" name="Total" required readonly>
		<hr/>

    <button  type="button" id="Price" class="registerbtn">Get Price</button>
    <input type="submit" id="SaveQuote" Value="Save Quote" class="registerbtn" />
</div>
</form>
  <form action = "fuelHistory.php">
    <button type="submit" class="registerbtn">View Fuel Quote History</button>
  </form>
  <form action = "clientProfMan.php">
    <button type="submit" class="registerbtn">Profile Management</button>
  </form>
  <form action = "Login.php">
    <button type="submit" class="registerbtn"> Home Button</button>
  </form>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
          $("#Price").click(function(e){
            var Gal = $(Gallons).val();
            var Date = $(date).val();
            if(Gal !== '' && Date !== '')
            {
              var Month = Date.substring(5,7);
              if(Month.charAt(0) == '0')
              {
                Month = Month.substring(1);
              }
              $.ajax({
                  url: "PricingModule.php",
                  type: "post",
                  dataType: 'json',
                  data: {Gallons : Gal,
                         Month : Month },
                  success: function (response) {
                    // you will get response from your php page (what you echo or print)                 
                      $("#SPrice").val(response.a);
                      $("#TPrice").val(response.b);
                      console.log("Done!");
                  },
                  error: function()
                  {
                    console.log("Failed");
                  }

              });
            }    
          });
    });  

</script> 