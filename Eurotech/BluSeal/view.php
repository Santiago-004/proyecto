<link href="./css/style.css" rel="stylesheet">
<form action="" method="post" class="formulario-busqueda">
    <input type="hidden" name="page" value="BluSeal">
    <label>**Model:</label>
    <select name="modelsearch" id="">
        <option value="">All</option>
        <?php /* foreach ($Models as $Model) {  ?>
            <option value="<?php echo $Model['Model'] ?>" <?php if ($modelsearch == $Model['Model']) { echo 'selected';} ?>><?php echo $Model['Model'] ?></option>
        <?php } */ ?>
    </select>

    <label>**Description:</label>
    <select name="descsearch" id="">
        <option value="">All</option>
        <?php /* foreach ($Descs as $Desc) {  ?>
            <option value="<?php echo $Desc['Description'] ?>" <?php if ($descsearch == $Desc['Description']) { echo 'selected';} ?>><?php echo $Desc['Description'] ?></option>
        <?php } */ ?>
    </select>

    <label>**Customer:</label>
    <input type="text" name="custsearch" list="Customer" value="<?php // if ($custsearch != NULL) { echo $custsearch;} ?>">
    <datalist id="Customer">
        <?php /*foreach ($Customers as $Customer) {  ?>
            <option value="<?php echo $Customer['Name'] ?>">
        <?php } */?>
    </datalist>

    <label>**Customer PN:</label>
    <input type="text" name="cpnsearch" list="CPN" value="<?php // if ($cpnsearch != NULL) { echo $cpnsearch;} ?>">
    <datalist id="CPN">
        <?php /*foreach ($CPNS as $CPN) {  ?>
            <option value="<?php echo $CPN['BS_Customer_PN'] ?>">
        <?php }*/ ?>
    </datalist>

    <label>**IMDS:</label>
    <input type="text" name="imdssearch" list="IMDS" value="<?php // if ($imdssearch != NULL) { echo $imdssearch;} ?>">
    <datalist id="IMDS">
        <?php /* foreach ($IMDS as $IM) {  ?>
            <option value="<?php echo $IM['IMDS'] ?>">
        <?php } */ ?>
    </datalist>

    <label>**Supplier:</label>
    <select name="suppsearch" id="">
        <option value="">All</option>
        <?php /* foreach ($Suppliers as $Supplier) {  ?>
            <option value="<?php echo $Supplier['Supplier'] ?>" <?php if ($suppsearch == $Supplier['Supplier']) { echo 'selected';} ?>><?php echo $Supplier['Supplier'] ?></option>
        <?php } */ ?>
    </select>

    <label>**Supplier PN:</label>
    <select name="spnsearch" id="">
        <option value="">All</option>
        <?php /* foreach ($SPNs as $SPN) {  ?>
            <option value="<?php echo $SPN['Supplier_PN'] ?>" <?php if ($spnsearch == $SPN['Supplier_PN']) { echo 'selected';} ?>><?php echo $SPN['Supplier_PN'] ?></option>
        <?php } */ ?>
    </select>

    <label>**PPAP Requested Date:</label>
    <input type="date" name="date1search" value="<?php // if ($date1search != NULL) { echo $date1search;} ?>"> - <input type="date" name="date2search" value="<?php // if ($date2search != NULL) { echo $date2search;} ?>">

    <label>**PPAP Received Date:</label>
    <input type="date" name="date3search" value="<?php // if ($date3search != NULL) { echo $date3search;} ?>"> - <input type="date" name="date4search" value="<?php // if ($date4search != NULL) { echo $date4search;} ?>">

    <label>**PPAP Sent Date:</label>
    <input type="date" name="date5search" value="<?php // if ($date5search != NULL) { echo $date5search;} ?>"> - <input type="date" name="date6search" value="<?php // if ($date6search != NULL) { echo $date6search;} ?>">

    <label>**PPAP Signed Date:</label>
    <input type="date" name="date7search" value="<?php // if ($date7search != NULL) { echo $date7search;} ?>"> - <input type="date" name="date8search" value="<?php // if ($date8search != NULL) { echo $date8search;} ?>">

    

    <button type="submit" name="btnsearch" class="insert">Search</button>
</form>

<form action="?page=Cables" method="post">
    <!-- <input type="hidden" name="insert" value="1"> -->
    <button type="submit" class="insert">New PPAP</button>
</form>

<?php if($logs == NULL) { ?>
    <h1>There are no logs at this moment.</h1>
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
                <th style="background-color:#1c18AA; color:white">Requested Date</th>
                <th style="background-color:#1c18AA; color:white">Received Date</th>
                <th style="background-color:#1c18AA; color:white">Sent to Customer</th>
                <th style="background-color:#1c18AA; color:white">Signed Date</th>
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
                    if($log['PPAP_Received_Date'] != NULL) { 
                        $recDate = new DateTime($log['PPAP_Received_Date']); ?>
                        <td><?php echo $recDate->format('m/d/Y') ?></td>
                    <?php }
                    if($log['PPAP_Received_Date'] == NULL) { ?>
                        <td></td>
                    <?php }
                    if($log['Sent_Customer'] != NULL) { 
                        $sentCust = new DateTime($log['Sent_Customer']); ?>
                        <td><?php echo $sentCust->format('m/d/Y') ?></td>
                    <?php }
                    if($log['Sent_Customer'] == NULL) { ?>
                        <td></td>
                    <?php } 
                    if($log['PPAP_Signed_Date'] != NULL) { 
                        $signDate = new DateTime($log['PPAP_Signed_Date']); ?>
                        <td><?php echo $signDate->format('m/d/Y') ?></td>
                    <?php }
                    if($log['PPAP_Signed_Date'] == NULL) { ?>
                        <td></td>
                    <?php } ?>
                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } ?>