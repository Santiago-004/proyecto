<link href="./css/style.css" rel="stylesheet">
<?php if($logs == NULL) { ?>
    <h1>There are no logs at this moment.</h1>
<?php } ?>

<?php if($logs != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">CUSTOMER</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">PPAP Level</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">SAP No.</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">Customer Part No.</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">Tape</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">Width (MM)</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">Length (M)</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">Color</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">IMDS ID no.</th>
                <th style="background-color:#1c18AA; color:white" colspan="2">INITIAL</th>
                <?php for($i = 2024; $i <= date("Y"); $i++) { ?>
                    <th style="background-color:#1c18AA; color:white" colspan="4"><?php echo $i; ?></th>
                <?php } ?>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">PPAP from shipments</th>
                <th style="background-color:#1c18AA; color:white; border-bottom: 1px solid #1c18AA;" colspan="1" rowspan="2">Comments</th>
            </tr>
            <tr>
                <th style="background-color:#1c18AA; color:white">Returned from CTC / Sent to Customer</th>
                <th style="background-color:#1c18AA; color:white">PSW returned from Customer signed / Sent to CTC</th>
                <?php for($i = 2024; $i <= date("Y"); $i++) { ?>
                    <th style="background-color:#1c18AA; color:white">Renewal Date</th>
                    <th style="background-color:#1c18AA; color:white">When to send Request to CTC</th>
                    <th style="background-color:#1c18AA; color:white">Sent to Customer</th>
                    <th style="background-color:#1c18AA; color:white">PSW returned from Customer signed</th>
                <?php } ?>
            </tr>
            
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <td><?php echo $log['Name']; ?></td>
                    <td><?php echo $log['PPAP_level']; ?></td>
                    <td><?php echo $log['SAP_Number']; ?></td>
                    <td><?php echo $log['FK_TAP_Customer_PN']; ?></td>
                    <td><?php echo $log['Tape']; ?></td>
                    <td><?php echo $log['Width']; ?></td>
                    <td><?php echo $log['Length']; ?></td>
                    <td><?php echo $log['Color']; ?></td>
                    <td><?php echo $log['IMDS_ID_No']; ?></td>
                    <?php if($log['Returned_CTC-Sent_Cust'] != NULL) { 
                        $retCtc = new DateTime($log['Returned_CTC-Sent_Cust']); ?>
                        <td><?php echo $retCtc->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Returned_CTC-Sent_Cust'] == NULL) { ?>
                        <td></td>
                    <?php } 
                    if($log['Cust_Signed-Sent_CTC'] != NULL) { 
                        $custSign = new DateTime($log['Cust_Signed-Sent_CTC']); ?>
                        <td><?php echo $custSign->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Cust_Signed-Sent_CTC'] == NULL) { ?>
                        <td></td>
                    <?php } 
                    for($i = 2024; $i <= date("Y"); $i++) {
                        $Renewlogs = $model->searchRenew($log['ID_TAP_PPAP'], $i);
                        if($Renewlogs == NULL) { ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php }
                        foreach ($Renewlogs as $Renewlog) { 
                            if($Renewlog['Renewal_Date'] != NULL) { 
                                $renDate = new DateTime($Renewlog['Renewal_Date']); ?>
                                <td><?php echo $renDate->format('m/d/Y') ?></td>
                            <?php }
                            if($Renewlog['Renewal_Date'] == NULL) { ?>
                                <td></td>
                            <?php }
                            if($Renewlog['Send_Request_CTC'] != NULL) { 
                                $sendReq = new DateTime($Renewlog['Send_Request_CTC']); ?>
                                <td><?php echo $sendReq->format('m/d/Y') ?></td>
                            <?php }
                            if($Renewlog['Send_Request_CTC'] == NULL) { ?>
                                <td></td>
                            <?php }
                            if($Renewlog['Sent_Customer'] != NULL) { 
                                $sentCust = new DateTime($Renewlog['Sent_Customer']); ?>
                                <td><?php echo $sentCust->format('m/d/Y') ?></td>
                            <?php }
                            if($Renewlog['Sent_Customer'] == NULL) { ?>
                                <td></td>
                            <?php }
                            if($Renewlog['Returned_Cust_Signed'] != NULL) { 
                                $retCust = new DateTime($Renewlog['Returned_Cust_Signed']); ?>
                                <td><?php echo $retCust->format('m/d/Y') ?></td>
                            <?php }
                            if($Renewlog['Returned_Cust_Signed'] == NULL) { ?>
                                <td></td>
                            <?php }             
                        }
                    } ?> 
                    <td><?php echo $log['PPAP_from_shipments']; ?></td>
                    <td><?php echo $log['Comments']; ?></td>
                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } ?>