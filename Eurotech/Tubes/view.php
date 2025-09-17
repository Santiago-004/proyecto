<link href="./css/style.css" rel="stylesheet">
<?php if($logs == NULL) { ?>
    <h1>There is no logs at this moment.</h1>
<?php } ?>

<?php if($logs != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th style="background-color:#1c18AA; color:white">Days to Submit</th>
                <th style="background-color:#1c18AA; color:white">PPAP Number</th>
                <th style="background-color:#1c18AA; color:white">PPAP Req'd by Customer</th>
                <th style="background-color:#1c18AA; color:white">Current Status</th>
                <th style="background-color:#1c18AA; color:white">PPAP/IMDS from</th>
                <th style="background-color:#1c18AA; color:white">Customer</th>
                <th style="background-color:#1c18AA; color:white">Country</th>
                <th style="background-color:#1c18AA; color:white">Customer PN</th>
                <th style="background-color:#1c18AA; color:white">ET Model</th>
                <th style="background-color:#1c18AA; color:white">ET Dwg</th>
                <th style="background-color:#1c18AA; color:white">Rev</th>
                <th style="background-color:#1c18AA; color:white">ET PN</th>
                <th style="background-color:#1c18AA; color:white">Description</th>
                <th style="background-color:#1c18AA; color:white">IMDS Number</th>
                <th style="background-color:#1c18AA; color:white">IMDS Status</th>
                <th style="background-color:#1c18AA; color:white">PPAP_do</th>
                <th style="background-color:#1c18AA; color:white">Level</th>
                <th style="background-color:#1c18AA; color:white">PPAP samples status</th>
                <th style="background-color:#1c18AA; color:white">Reason of Submission</th>
                <th style="background-color:#1c18AA; color:white">Sent to Customer</th>
                <th style="background-color:#1c18AA; color:white">PSW returned from Cust Signed</th>
                <th style="background-color:#1c18AA; color:white">Origin from report</th>
                <th style="background-color:#1c18AA; color:white">Comments</th>
                <th style="background-color:#1c18AA; color:white">Inspection Report Number</th>
            </tr>
            
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <td 
                        <?php if($log['Days to Submit'] <= 18) { ?>
                            style="background-color:#00C100; color:black"
                        <?php } 
                        if($log['Days to Submit'] >= 19 && $log['Days to Submit'] <= 30) { ?>
                            style="background-color:yellow; color:black"
                        <?php } 
                        if($log['Days to Submit'] >= 31) { ?>
                            style="background-color:#FF0000; color:white"
                        <?php } ?>
                    ><?php echo $log['Days to Submit']; ?></td>
                    <td><?php echo $log['PPAP_Number']; ?></td>
                    <?php if($log['PPAP_Req_by_Cus_Date'] != NULL) { 
                        $reqDate = new DateTime($log['PPAP_Req_by_Cus_Date']); ?>
                        <td><?php echo $reqDate->format('d/m/Y') ?></td>
                    <?php }
                    if($log['PPAP_Req_by_Cus_Date'] == NULL) { ?>
                        <td></td>
                    <?php } ?>
                    <td><?php echo $log['Current_Status']; ?></td>
                    <td><?php echo $log['Vendor']; ?></td>
                    <td><?php echo $log['Name']; ?></td>
                    <td><?php echo $log['Country']; ?></td>
                    <td><?php echo $log['TUB_Customer_PN']; ?></td>
                    <td><?php echo $log['ET_Model']; ?></td>
                    <td><?php echo $log['ET_Dwg']; ?></td>
                    <td><?php echo $log['Rev']; ?></td>
                    <td><?php echo $log['Eurotech_PN_TUB']; ?></td>
                    <td><?php echo $log['Description']; ?></td>
                    <td><?php echo $log['IMDS_Number']; ?></td>
                    <td><?php echo $log['IMDS_Status']; ?></td>
                    <td><?php echo $log['PPAP_do']; ?></td>
                    <td><?php echo $log['Level']; ?></td>
                    <td><?php echo $log['Samples_Status']; ?></td>
                    <td><?php echo $log['Reason_submission']; ?></td>
                    <?php if($log['Sent_Customer'] != NULL) { 
                        $sentCust = new DateTime($log['Sent_Customer']); ?>
                        <td><?php echo $sentCust->format('d/m/Y') ?></td>
                    <?php }
                    if($log['Sent_Customer'] == NULL) { ?>
                        <td></td>
                    <?php } 
                    if($log['PSW_Returned'] != NULL) { 
                        $pswRet = new DateTime($log['PSW_Returned']); ?>
                        <td><?php echo $pswRet->format('d/m/Y') ?></td>
                    <?php }
                    if($log['PSW_Returned'] == NULL) { ?>
                        <td></td>
                    <?php } ?>
                    <td><?php echo $log['Origin_from_report']; ?></td>
                    <td><?php echo $log['Comments']; ?></td>
                    <td><?php echo $log['Inspection_rep_numb']; ?></td>
                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } ?>