<link href="./css/style.css" rel="stylesheet">
<?php if($logs == NULL) { ?>
    <h1>There is no logs at this moment.</h1>
<?php } ?>

<?php if($logs != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th style="background-color:#1c18AA; color:white">Date</th>
                <th style="background-color:#1c18AA; color:white">CUS</th>
                <th style="background-color:#1c18AA; color:white">CUS PN</th>
                <th style="background-color:#1c18AA; color:white">TAPE</th>
                <th style="background-color:#1c18AA; color:white">CTC</th>
                <th style="background-color:#1c18AA; color:white">Form sent CUS</th>
                <th style="background-color:#1c18AA; color:white">Reminder</th>
                <th style="background-color:#1c18AA; color:white">Received/RQ sent CTC</th>
                <th style="background-color:#1c18AA; color:white">Closing Date</th>
                <th style="background-color:#1c18AA; color:white">Comments</th>
            </tr>
            
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <?php 
                    if($log['Date'] != NULL) { 
                        $date = new DateTime($log['Date']); ?>
                        <td><?php echo $date->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Date'] == NULL) { ?>
                        <td></td>
                    <?php } ?>
                    <td><?php echo $log['Name']; ?></td>
                    <td><?php echo $log['FK_TAP_Customer_PN']; ?></td>
                    <td><?php echo $log['Description']; ?></td>
                    <td><?php echo $log['CTC']; ?></td>
                    <?php if($log['Form_Sent_Cust'] != NULL) { 
                        $formSent = new DateTime($log['Form_Sent_Cust']); ?>
                        <td><?php echo $formSent->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Form_Sent_Cust'] == NULL) { ?>
                        <td></td>
                    <?php }
                    if($log['Reminder'] != NULL) { 
                        $Reminder = new DateTime($log['Reminder']); ?>
                        <td><?php echo $Reminder->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Reminder'] == NULL) { ?>
                        <td></td>
                    <?php } 
                    if($log['Received-RQ_Sent_CTC'] != NULL) { 
                        $received = new DateTime($log['Received-RQ_Sent_CTC']); ?>
                        <td><?php echo $received->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Received-RQ_Sent_CTC'] == NULL) { ?>
                        <td></td>
                    <?php }
                    if($log['Closing_Date'] != NULL) { 
                        $closingDate = new DateTime($log['Closing_Date']); ?>
                        <td><?php echo $closingDate->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Closing_Date'] == NULL) { ?>
                        <td></td>
                    <?php } ?>
                    <td><?php echo $log['Comments']; ?></td>

                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } ?>