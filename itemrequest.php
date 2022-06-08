<?php  
	session_start();  
    $con = mysqli_connect("localhost","root","","inventory_system") or die("Error");
    // $price =$_SESSION['pricePerStock'];
    $item = $_SESSION['itemName'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Request Item</title>
	<style>

	</style>
	<link rel="stylesheet" type="text/css" href="StaffD-style.css">
</head>
<body>
	
	<form method="post">
			                    <table>
                        <!--INSERT PHP CODE HERE-->

                        <tr>
                            <tr>
                                <th>Item Name</th>
                                <th>Stock</th>
                                <th>Price Per Stock</th>
                                <th>Username</th>
                            </tr>
				<?php  
                                if($con){
                                    $query = "SELECT * FROM `items` WHERE `itemName` = '$item' ";
                                    $requests = mysqli_query($con,$query);//returned results
                                    $check = mysqli_num_rows($requests);//result counter
                                    if($check == 0){//if empt
                                        //setonly 1 row of N/A if the table is empty;
                                    }else{
                                        while($row = mysqli_fetch_assoc($requests)){
                                            echo "
                                        <tr>
                                            <td>".$row['itemName']."</td>
                                            <td>".$row['stocks']."</td>
                                            <td>".$row['pricePerStock']."</td>
                                            <td>".$row['userName']."</td>
                                        </tr>";
                                        }
                                    }
                                }
                            ?>            
                        </div>
                    </table>
	
	<label>Quantity</label><br>
	<input type="text" name="quantity" placeholder="input quantity"><br>
	<input type="submit" name="btnreq" style="margin-right: 50px;" value="Request">
	</form>

	<?php

		if(isset($_POST['btnreq'])){
			$quantity = $_POST['quantity'];
			$upitem = $_SESSION['itemName'];
			$username = $_SESSION['userName'];
    			$price = $_SESSION['pricePerStock'];
    			$payment = $quantity*$price;

			$add = "INSERT INTO `itemrequests`(`itemName`, `quantityRequest`, `payment`, `userName`) VALUES ('$upitem','$quantity','$payment','$username')";
			$resultadd = mysqli_query($con, $add);
			header("location: staffdashboard.php");			
		}  
	?>
</body>
</html>
