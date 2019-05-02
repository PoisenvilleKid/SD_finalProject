<!DOCTYPE html>

<html>

<head>

<title>Fuel History</title>
<link rel="stylesheet" href="clientProfMan.CSS" />
</head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<body>

<h1 align="left" style ="color:green">Fuel Quote Table:</h1>

<form>

<table style="width:100%" id = "customers">
    <thead>
        <tr>
            <th>Gallons Requested:</th>
            <th>Delivery Address:</th>
            <th>Delivery Date:</th>
            <th>Suggested Price:</th>
            <th>Total Amount Due:</th>
        </tr>
    </thead>
    <?php

        session_start();
    
        // Set Up The DB Variables
        $user = 'root';
        $pass = '';
        $db = 'test_1';

        // Connect To DB
        $db = new mysqli('localhost',$user, $pass, $db);

        $UserName = $_SESSION['username'];

        if($db-> connect_error){
            die("Connection failed:". $con-> connect_error);
        }

        $sql = "SELECT * FROM history WHERE username = '$UserName'";
        $result = $db -> query($sql) or die($con->error);

        
        while($row = $result->fetch_assoc()){
            echo "<tr><td>".$row["gallons"]."</td><td>".$row["address"]."</td><td>".$row["date"]."</td><td>".$row["price"]."</td><td>".$row["total"]."</td></tr>";            
        }
        echo"</table>";
        $db -> close();
  ?>  
</table>
<br>
<br>

<form action = "Login.php">
    <button type="submit" class="registerbtn">/ button>
</form>
<form action = "fuelQuote.php">
    <button type="submit" class="registerbtn">Click here to return to Quote page</button>
</form>
<form action = "Login.php">
    <button type="submit" class="registerbtn">Click here to return to login page</button>
</form>
</form>
</body>
</html>