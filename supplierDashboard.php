<!DOCTYPE html>
<html>
    <head>
        <title>Supplier Dashboard</title>
	    <link rel="stylesheet" type="text/css" href="SuppD-style.css">
	    <h1>SUPPLIER DASHBOARD</h1>
    </head>  
    <body>
        <div>
            <label style="padding-left: 140px;">Welcome xx_aladdin_xx!</label>
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
                    $requests = mysqli_query($conn,$query);
                    $check = mysqli_num_rows($requests);
                    if($check == 0){
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
        </table>
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
            <tr>
                <td>001</td>
                <td>01</td>
                <td>Orange</td>
                <td>200</td>
                <td>xx_aladin_xx</td>
                <td>xx_aladin_xx</td>
                <td>0</td>
            </tr>
            <tr>
                <td>002</td>
                <td>02</td>
                <td>Apple</td>
                <td>100</td>
                <td>princessJ</td>
                <td>princessJ</td>
                <td>0</td>
            </tr>
            </table> </br>
            <form>
                <select name ="dropdown" id="dropdown_selected">
                    <option value="">-----------------SELECT-----------------</option></select>
                    <button type="reset">Cancel</button>
                    <button type="button" onclick="alert('Delivered!')" style="margin-right: 20px;">Deliver</button>
            </form> 
            </div>
        </div>
    </body>
</html>
