<!DOCTYPE html>
<html>
    <head>
        <title>Supplier Dashboard</title>
	    <link rel="stylesheet" type="text/css" href="SuppD-style.css">
	    <h1>SUPPLIER DASHBOARD</h1>
    </head>  
    <body>
        <div>
            <label style="padding-left: 140px;">Welcome <?php session_start(); print_r($_SESSION["userName"])?>!</label>
        <div>

        <div class="row">
        <div class="column">
        <h2>ITEM REQUEST</h2>
        <table>
            <!--INSERT PHP CODE HERE-->
            <tr>
            <tr>
                <th>Request ID</th>
                <th>Item Name</th>
                <th>Quantity Request</th>
                <th>Payment</th>
                <th>Username</th>
            </tr>
            <?php
                $sname= "localhost";
                $username= "root";
                $password = "";
                
                $db_name = "inventory_system";
                
                $conn = mysqli_connect($sname, $username, $password, $db_name);
                if($conn){
                    $query = "SELECT * FROM itemrequests";
                    $requests = mysqli_query($conn,$query);//returned results
                    $check = mysqli_num_rows($requests);//result counter
                    if($check == 0){//if empty
                        //setonly 1 row of N/A if the table is empty
                            echo "
                                <tr>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>";
                    }
                    else{
                        while($row = mysqli_fetch_assoc($requests)){
                            echo "
                                <tr>
                                    <td>".$row['requestID']."</td>
                                    <td>".$row['itemName']."</td>
                                    <td>".$row['quantityRequest']."</td>
                                    <td>".$row['payment']."</td>
                                    <td>".$row['userName']."</td>
                                </tr>";
                        }
                    }
                }
                else{
                    echo "<script>alert('Connection failed');</script>";
                }
            ?>
        </table></br>
        <form method = "post">
                <select name ="dropdownItemRequest" id="dropdown_selectedItemRequest">
                    <option value="---------------SELECT-----------------">-----------------SELECT-----------------</option>
                </select>
                <button type="submit" name = "deliver" style="margin-right: 135px;">Deliver</button>
        </form> 
        </div>
        
        <div class="column">
        <h2>DELIVERIES</h2>
        <table>
            <!--INSERT PHP CODE HERE-->
            <tr>
                <th>Delivery ID</th>
                <th>Request ID</th>
                <th>Item Name</th>
                <th>Quantity Delivered</th>
                <th>Staff Username</th>
                <th>Supplier Username</th>
                <th>Payment Change</th>
            </tr>
            <?php
                if($conn){
                    $query = "SELECT * FROM deliveryitem";
                    $deliveries = mysqli_query($conn,$query);
                    $check = mysqli_num_rows($deliveries);
                    if($check == 0){
                        echo "
                                <tr>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>";
                    }
                    else{
                        while($row = mysqli_fetch_assoc($deliveries)){
                            echo "
                                <tr>
                                    <td>".$row['deliveryID']."</td>
                                    <td>".$row['requestID']."</td>
                                    <td>".$row['itemName']."</td>
                                    <td>".$row['quantityDelivered']."</td>
                                    <td>".$row['staff_userName']."</td>
                                    <td>".$row['supplier_userName']."</td>
                                    <td>".$row['paymentChange']."</td>
                                </tr>";
                        }
                    }
                }else{
                    echo "<script>alert('Connection failed');</script>";
                }
            ?>
            </table> </br>
            <form method = "post">
                <select name ="dropdownItemRequest" id="dropdown_selectedItemRequest">
                    <option value="-----------------SELECT-----------------">-----------------SELECT-----------------</option>

                </select> 
                <button type="submit" name="cancelDelivery">Cancel</button>
            </form> 
            </div>
        </div>
    </body>
</html>

<?php
    if($conn){
        if(isset($_POST['deliver'])){
            $postSelected_request = $_POST['dropdownItemRequest'];
            $must_select_req = "Must select a request to deliver";
            //to be continued in implementing the selected itemrequest to deliver
            
        }
        else if(isset($_POST['cancelDelivery'])){
            $postSelected_delivery = $_POST['dropdownDeliveries'];
            $must_select_del = "Must select a delivery to cancel.";
            //to be continued in implementing the selected delivery to cancel
        }
    }
?>
