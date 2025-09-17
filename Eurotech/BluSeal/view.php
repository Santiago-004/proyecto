<link href="./css/style.css" rel="stylesheet">
<?php if($logs == NULL) { ?>
    <h1>There is no logs at this moment.</h1>
<?php } ?>

<?php if($logs != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th style="background-color:#1c18AA; color:white">Model</th>
                <th style="background-color:#1c18AA; color:white">Description</th>
                <th style="background-color:#1c18AA; color:white">Customer</th>
                <th style="background-color:#1c18AA; color:white">Customer PN</th>
                <th style="background-color:#1c18AA; color:white">IMDS</th>
                <th style="background-color:#1c18AA; color:white">Supplier</th>
                <th style="background-color:#1c18AA; color:white">Supplier PN</th>
                <th style="background-color:#1c18AA; color:white">Request Date</th>
                <th style="background-color:#1c18AA; color:white">Sent to Customer</th>
            </tr>
            
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <td><?php echo $log['Model']; ?></td>
                    <td><?php echo $log['Description']; ?></td>
                    <td><?php echo $log['Name']; ?></td>
                    <td><?php echo $log['BS_Customer_PN']; ?></td>
                    <td><?php echo $log['IMDS']; ?></td>
                    <td><?php echo $log['Supplier']; ?></td>
                    <td><?php echo $log['Supplier_PN']; ?></td>
                    <?php if($log['Request_Date'] != NULL) { 
                        $reqDate = new DateTime($log['Request_Date']); ?>
                        <td><?php echo $reqDate->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Request_Date'] == NULL) { ?>
                        <td></td>
                    <?php }
                    if($log['Sent_Customer'] != NULL) { 
                        $sentCust = new DateTime($log['Sent_Customer']); ?>
                        <td><?php echo $sentCust->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Sent_Customer'] == NULL) { ?>
                        <td></td>
                    <?php } ?>
                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } ?>