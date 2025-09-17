<link href="./css/style.css" rel="stylesheet">
<?php if($logs == NULL) { ?>
    <h1>There is no logs at this moment.</h1>
<?php } ?>

<?php if($logs != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th style="background-color:#1c18AA; color:white">Eurotech PN</th>
                <th style="background-color:#1c18AA; color:white">Coroflex PN</th>
                <th style="background-color:#1c18AA; color:white">Customer PN</th>
                <th style="background-color:#1c18AA; color:white">Description</th>
                <th style="background-color:#1c18AA; color:white">PPAP Requested</th>
                <th style="background-color:#1c18AA; color:white">Signed Date</th>
                <th style="background-color:#1c18AA; color:white">Customer</th>
            </tr>
            
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <?php if($log['Name'] != NULL && $log['PPAP_Signed_Date'] == NULL) { ?>
                        <td style="background-color:yellow; color:black"><?php echo $log['Eurotech_PN_CAB']; ?></td>
                        <td style="background-color:yellow; color:black"><?php echo $log['Coroflex_PN']; ?></td>
                        <td style="background-color:yellow; color:black"><?php echo $log['CAB_Customer_PN']; ?></td>
                        <td style="background-color:yellow; color:black"><?php echo $log['Description']; ?></td>
                        <?php if($log['PPAP_Requested_Date'] != NULL) { 
                            $reqDate = new DateTime($log['PPAP_Requested_Date']); ?>
                            <td style="background-color:yellow; color:black"><?php echo $reqDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Requested_Date'] == NULL) { ?>
                            <td style="background-color:yellow; color:black"></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] != NULL) { 
                            $signDate = new DateTime($log['PPAP_Signed_Date']); ?>
                            <td style="background-color:yellow; color:black"><?php echo $signDate->format('m/d/Y') ?></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] == NULL) { ?>
                            <td style="background-color:yellow; color:black"></td>
                        <?php } ?>
                        <td style="background-color:yellow; color:black"><?php echo $log['Name']; ?></td>
                    <?php } ?>
                    <?php if($log['Name'] != NULL && $log['PPAP_Signed_Date'] != NULL) { ?>
                        <td style="background-color:#00C900; color:black"><?php echo $log['Eurotech_PN_CAB']; ?></td>
                        <td style="background-color:#00C900; color:black"><?php echo $log['Coroflex_PN']; ?></td>
                        <td style="background-color:#00C900; color:black"><?php echo $log['CAB_Customer_PN']; ?></td>
                        <td style="background-color:#00C900; color:black"><?php echo $log['Description']; ?></td>
                        <?php if($log['PPAP_Requested_Date'] != NULL) { 
                            $reqDate = new DateTime($log['PPAP_Requested_Date']); ?>
                            <td style="background-color:#00C900; color:black"><?php echo $reqDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Requested_Date'] == NULL) { ?>
                            <td style="background-color:#00C900; color:black"></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] != NULL) { 
                            $signDate = new DateTime($log['PPAP_Signed_Date']); ?>
                            <td style="background-color:#00C900; color:black"><?php echo $signDate->format('m/d/Y') ?></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] == NULL) { ?>
                            <td style="background-color:#00C900; color:black"></td>
                        <?php } ?>
                        <td style="background-color:#00C900; color:black"><?php echo $log['Name']; ?></td>
                    <?php } ?>
                    <?php if($log['Name'] == NULL) { ?>
                        <td><?php echo $log['Eurotech_PN_CAB']; ?></td>
                        <td><?php echo $log['Coroflex_PN']; ?></td>
                        <td><?php echo $log['CAB_Customer_PN']; ?></td>
                        <td><?php echo $log['Description']; ?></td>
                        <?php if($log['PPAP_Requested_Date'] != NULL) { 
                            $reqDate = new DateTime($log['PPAP_Requested_Date']); ?>
                            <td><?php echo $reqDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Requested_Date'] == NULL) { ?>
                            <td></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] != NULL) { 
                            $signDate = new DateTime($log['PPAP_Signed_Date']); ?>
                            <td><?php echo $signDate->format('m/d/Y') ?></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] == NULL) { ?>
                            <td></td>
                        <?php } ?>
                        <td><?php echo $log['Name']; ?></td>
                    <?php } ?>
                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } ?>