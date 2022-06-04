<!DOCTYPE html>
<html>
    <head>
        <title>Staff Dashboard</title>
	    <link rel="stylesheet" type="text/css" href="SuppD-style.css">
	    <h1>SUPPLIER DASHBOARD</h1>
    </head>  
    <body>
        <div>
		    <label style="float: center;" >Welcome xx_aladin_xx!</label>
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
        </table>
        </div>
        
        <div class="column">
        <h2>DELIVERIES</h2>
        <table style="width">
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
                    <option value="">---SELECT---</option></select>
                    <button type="reset">Cancel</button>
                    <button type="button" style="margin-right: 20px;">Deliver</button>
            </form> 
            </div>
        </div>
    </body>
</html>
