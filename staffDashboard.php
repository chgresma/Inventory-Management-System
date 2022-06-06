<!DOCTYPE html>
<?php
    session_start();  
    $con = mysqli_connect("localhost","root","","inventory_system") or die("Error");
?>
<html>

<head>
    <title>Staff Dashboard</title>
    <link rel="stylesheet" type="text/css" href="StaffD-style.css">
    <h1>STAFF DASHBOARD</h1>
</head>

<body>
    <div>
        <label style="float: center;">Welcome <?php echo  $_SESSION['userName']; ?>!</label>


        <div>
            <label style="float:left;">
            <div class="row">
                <div class="column">
                    <h2>ITEM</h2>
                    <table>
                        <!--INSERT PHP CODE HERE-->
                        <tr>
                            <tr>
                                <th>Item Name</th>
                                <th>Stock</th>
                                <th>Price Per Stock</th>
                                <th>Username</th>
                            </tr>
                            <tr>
                                <td>Apple</td>
                                <td>50</td>
                                <td>10</td>
                                <td>xx_aladin_xx</td>
                            </tr>
                            <tr>
                                <td>Orange</td>
                                <td>50</td>
                                <td>10</td>
                                <td>princessMae</td>
                            </tr>

                        </div>
                    </table>
                    <br>

                    <form method="post">

                        <button type="button" name="btnupdate" style="margin-right: 5px;"> Update</button>
                        <button type="reset" name="btndelete" style="margin-right: 5px;"> Delete </button>
                        <button type="button" name="btnadd" style="margin-right: 5px;">Add</button>
                        <select name="dropdown" id="dropdown_selected">
                        <option value="">-SELECT-</option>
                        <?php  
                            
                            if($con){
                                $list = "select itemName from items";
                                $sql = mysqli_query($con,$list);
                                while ($data = mysqli_fetch_assoc($sql)) {
                                if(!empty($_POST['dropdown']) && $_POST['dropdown'] == $data['dropdown']){
                                    $selected = 'selected ="selected"';
                                }
                                else{
                                    $selected = '';
                                }
                                ?>
                                <option value = "<?php echo $data['itemName']; ?>" $selected><?php echo $data['itemName']; ?></option>
                                <?php
                            }
                            }
                        ?>
                    </select>


                    </form>
                </div>
            <br> 
            <br>
            &nbsp;&nbsp;&nbsp;
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
                                <tr>
                                    <td>01</td>
                                    <td>Orange</td>
                                    <td>20</td>
                                    <td>200</td>
                                    <td>xx_aladin_xx</td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>Apple</td>
                                    <td>10</td>
                                    <td>100</td>
                                    <td>princessJ</td>
                            </tr>
                                    </form>
                            </table>
                            <br>
        
                            <form>
        
                                <button type="button" style="margin-right: 10px;"> Request</button>
                                <button type="reset" style="margin-right: 50px;"> Cancel </button>
                                <select name="dropdown" id="dropdown_selected">
                                <option value="">-SELECT-</option>
                                 <?php  
                            
                            if($con){
                                $list = "select itemName from itemrequests";
                                $sql = mysqli_query($con,$list);
                                while ($data = mysqli_fetch_assoc($sql)) {
                                if(!empty($_POST['dropdown']) && $_POST['dropdown'] == $data['dropdown']){
                                    $selected = 'selected ="selected"';
                                }
                                else{
                                    $selected = '';
                                }
                                ?>
                                <option value = "<?php echo $data['itemName']; ?>" $selected><?php echo $data['itemName']; ?></option>
                                <?php
                            }
                            }
                        ?>

                            </select>
    
        
                            </form>
                        </div>

            

             
            </div>





</body>

</html>
<?php if(isset($_POST['btnadd'])){
    $add = "select * from items";
    $resultadd = mysqli_query($con, $add);
}
        header('Location:makepayment.php'); ?>
