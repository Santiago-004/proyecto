<link href="./css/style.css" rel="stylesheet">
<form action="" method="post" class="formulario-busqueda">
    <input type="hidden" name="page" value="Cables">
    <label>Eurotech PN:</label>
    <input type="text" name="etpnsearch" list="ETPN" value="<?php if ($etpnsearch != NULL) { echo $etpnsearch;} ?>">
    <datalist id="ETPN">
        <?php foreach ($ETPNS as $ETPN) {  ?>
            <option value="<?php echo $ETPN['Eurotech_PN_CAB'] ?>">
        <?php }?>
    </datalist> 

    <!-- <select name="etpnsearch" id="">
        <option value="">All</option>
        <?php /*foreach ($ETPNS as $ETPN) {  ?>
                <option value="<?php echo $ETPN['Eurotech_PN_CAB'] ?>" <?php if ($etpnsearch == $ETPN['Eurotech_PN_CAB']) { echo 'selected';} ?>><?php echo $ETPN['Eurotech_PN_CAB'] ?></option>
            <?php } */ ?>
    </select> -->

    <label>**Coroflex PN:</label>
    <input type="text" name="copnsearch" list="COPN" value="<?php if ($copnsearch != NULL) { echo $copnsearch;} ?>">
    <datalist id="COPN">
        <?php foreach ($COPNS as $COPN) {  ?>
            <option value="<?php echo $COPN['Coroflex_PN'] ?>">
        <?php }?>
    </datalist>

    <label>Customer:</label>
    <input type="text" name="custsearch" list="Customer" value="<?php if ($custsearch != NULL) { echo $custsearch;} ?>">
    <datalist id="Customer">
        <?php foreach ($Customers as $Customer) {  ?>
            <option value="<?php echo $Customer['Name'] ?>">
        <?php }?>
    </datalist>

    <!-- <select name="custsearch" id="">
        <option value="">All</option>
        <?php /* foreach ($Customers as $Customer) {  ?>
            <option value="<?php echo $Customer['ID_CAB_Customer'] ?>" <?php if ($custsearch == $Customer['ID_CAB_Customer']) { echo 'selected';} ?>><?php echo $Customer['Name'] ?></option>
        <?php } */ ?>
    </select> -->

    <label>Customer PN:</label>
    <input type="text" name="cpnsearch" list="CPN" value="<?php if ($cpnsearch != NULL) { echo $cpnsearch;} ?>">
    <datalist id="CPN">
        <?php foreach ($CPNS as $CPN) {  ?>
            <option value="<?php echo $CPN['CAB_Customer_PN'] ?>">
        <?php } ?>
    </datalist>

    <label>Cable's description:</label>
    <input type="text" name="descsearch" list="Desc" value="<?php if ($descsearch != NULL) { echo $descsearch;} ?>">
    <datalist id="Desc">
        <?php foreach ($Descs as $Desc) {  ?>
            <option value="<?php echo $Desc['Description'] ?>">
        <?php } ?>
    </datalist>

    <label>PPAP Requested Date:</label>
    <input type="date" name="date1search" value="<?php if ($date1search != NULL) { echo $date1search;} ?>"> - <input type="date" name="date2search" value="<?php if ($date2search != NULL) { echo $date2search;} ?>">

    <label>**PPAP Received Date:</label>
    <input type="date" name="date5search" value="<?php if ($date5search != NULL) { echo $date5search;} ?>"> - <input type="date" name="date6search" value="<?php if ($date6search != NULL) { echo $date6search;} ?>">

    <label>**PPAP Sent Date:</label>
    <input type="date" name="date7search" value="<?php if ($date7search != NULL) { echo $date7search;} ?>"> - <input type="date" name="date8search" value="<?php if ($date8search != NULL) { echo $date8search;} ?>">

    <label>PPAP Signed Date:</label>
    <input type="date" name="date3search" value="<?php if ($date3search != NULL) { echo $date3search;} ?>"> - <input type="date" name="date4search" value="<?php if ($date4search != NULL) { echo $date4search;} ?>">

    <button type="submit" name="btnsearch" class="insert">Search</button>
</form>

<form action="?page=Cables" method="post">
    <input type="hidden" name="insert" value="1">
    <button type="submit" class="insert">New PPAP</button>
</form>

<!-- <form action="?page=Cables" method="post">
    <input type="hidden" name="insertEC" value="1">
    <button type="submit" class="insert">New PPAP</button>
</form> -->

<?php if($logs == NULL) { ?>
    <h1>There are no logs at this moment.</h1>
<?php } ?>

<?php if($logs != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th style="background-color:#1c18AA; color:white">Eurotech PN</th>
                <th style="background-color:#1c18AA; color:white">Coroflex PN</th>
                <th style="background-color:#1c18AA; color:white">Customer</th>
                <th style="background-color:#1c18AA; color:white">Customer PN</th>
                <th style="background-color:#1c18AA; color:white">Description</th>
                <th style="background-color:#1c18AA; color:white">PPAP Requested</th>
                <th style="background-color:#1c18AA; color:white">Received Date</th>
                <th style="background-color:#1c18AA; color:white">Sent Date</th>
                <th style="background-color:#1c18AA; color:white">Signed Date</th>
            </tr>
            
            <?php foreach ($logs as $log) { ?>
                <tr>
                    <?php if($log['Name'] != NULL && $log['PPAP_Signed_Date'] == NULL) { ?>
                        <td style="background-color:#FFEE00; color:black"><?php echo $log['Eurotech_PN_CAB']; ?></td>
                        <td style="background-color:#FFEE00; color:black"><?php echo $log['Coroflex_PN']; ?></td>
                        <td style="background-color:#FFEE00; color:black"><?php echo $log['Name']; ?></td>
                        <td style="background-color:#FFEE00; color:black"><?php echo $log['CAB_Customer_PN']; ?></td>
                        <td style="background-color:#FFEE00; color:black"><?php echo $log['Description']; ?></td>
                        <?php if($log['PPAP_Requested_Date'] != NULL) { 
                            $reqDate = new DateTime($log['PPAP_Requested_Date']); ?>
                            <td style="background-color:#FFEE00; color:black"><?php echo $reqDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Requested_Date'] == NULL) { ?>
                            <td style="background-color:#FFEE00; color:black"></td>
                        <?php } 
                        if($log['PPAP_Received_Date'] != NULL) { 
                            $recDate = new DateTime($log['PPAP_Received_Date']); ?>
                            <td style="background-color:#FFEE00; color:black"><?php echo $recDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Received_Date'] == NULL) { ?>
                            <td style="background-color:#FFEE00; color:black"></td>
                        <?php } 
                        if($log['PPAP_Sent_Date'] != NULL) { 
                            $sentDate = new DateTime($log['PPAP_Sent_Date']); ?>
                            <td style="background-color:#FFEE00; color:black"><?php echo $sentDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Sent_Date'] == NULL) { ?>
                            <td style="background-color:#FFEE00; color:black"></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] != NULL) { 
                            $signDate = new DateTime($log['PPAP_Signed_Date']); ?>
                            <td style="background-color:#FFEE00; color:black"><?php echo $signDate->format('m/d/Y') ?></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] == NULL) { ?>
                            <td style="background-color:#FFEE00; color:black"></td>
                        <?php } ?>
                    <?php } ?>
                    <?php if($log['Name'] != NULL && $log['PPAP_Signed_Date'] != NULL) { ?>
                        <td style="background-color:#00D900; color:black"><?php echo $log['Eurotech_PN_CAB']; ?></td>
                        <td style="background-color:#00D900; color:black"><?php echo $log['Coroflex_PN']; ?></td>
                        <td style="background-color:#00D900; color:black"><?php echo $log['Name']; ?></td>
                        <td style="background-color:#00D900; color:black"><?php echo $log['CAB_Customer_PN']; ?></td>
                        <td style="background-color:#00D900; color:black"><?php echo $log['Description']; ?></td>
                        <?php if($log['PPAP_Requested_Date'] != NULL) { 
                            $reqDate = new DateTime($log['PPAP_Requested_Date']); ?>
                            <td style="background-color:#00D900; color:black"><?php echo $reqDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Requested_Date'] == NULL) { ?>
                            <td style="background-color:#00D900; color:black"></td>
                        <?php } 
                        if($log['PPAP_Received_Date'] != NULL) { 
                            $recDate = new DateTime($log['PPAP_Received_Date']); ?>
                            <td style="background-color:#00D900; color:black"><?php echo $recDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Received_Date'] == NULL) { ?>
                            <td style="background-color:#00D900; color:black"></td>
                        <?php } 
                        if($log['PPAP_Sent_Date'] != NULL) { 
                            $sentDate = new DateTime($log['PPAP_Sent_Date']); ?>
                            <td style="background-color:#00D900; color:black"><?php echo $sentDate->format('m/d/Y') ?></td>
                        <?php }
                        if($log['PPAP_Sent_Date'] == NULL) { ?>
                            <td style="background-color:#00D900; color:black"></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] != NULL) { 
                            $signDate = new DateTime($log['PPAP_Signed_Date']); ?>
                            <td style="background-color:#00D900; color:black"><?php echo $signDate->format('m/d/Y') ?></td>
                        <?php } 
                        if($log['PPAP_Signed_Date'] == NULL) { ?>
                            <td style="background-color:#00D900; color:black"></td>
                        <?php } ?>
                    <?php } ?>
                    <?php if($log['Name'] == NULL) { ?>
                        <td><?php echo $log['Eurotech_PN_CAB']; ?></td>
                        <td><?php echo $log['Coroflex_PN']; ?></td>
                        <td><?php echo $log['Name']; ?></td>
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
                    <?php } ?>
                </tr> 
            <?php } ?>
        </table> 
    </div>
<?php } 
 
/* if (isset($_POST['insert'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="closeForm()">&times;</span>
    <h2>Register New PPAP</h2>
    <form action="?page=Cables" method="post">
        <input type="hidden" name="confirmI" value="1">
        <label>Customer PN:</label>
        <input type="text" name="CAB_Customer_PN" list="CPN" required>
        <datalist id="CPN">
            <?php foreach ($CPNS as $CPN) {  ?>
                <option value="<?php echo $CPN['CAB_Customer_PN'] ?>">
            <?php } ?>
        </datalist> <br>

        <label>PPAP Requested Date:</label>
        <input type="date" name="PPAP_Requested_Date" id="" required>

        <button type="submit">Save</button>
    </form>
  </div>
</div>
<?php } */

if (isset($_POST['insert'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="closeForm()">&times;</span>
    <h2>Register New PPAP</h2>
    <form action="?page=Cables" method="post">
        <input type="hidden" name="confirmI" value="1">
        <label>Cable's description:</label>
        <input type="text" name="Description" list="Desc" required>
        <datalist id="Desc">
            <?php foreach ($Descs as $Desc) {  ?>
                <option value="<?php echo $Desc['Description'] ?>">
            <?php } ?>
        </datalist> <br>

        <label>Customer:</label>
        <select name="ID_CAB_Customer" id="" required>
            <option value=""></option>
            <?php foreach ($Customers as $Customer) {  ?>
                <option value="<?php echo $Customer['ID_CAB_Customer'] ?>"><?php echo $Customer['Name'] ?></option>
            <?php }?>
        </select> <br>

        <label>PPAP Requested Date:</label>
        <input type="date" name="PPAP_Requested_Date" id="" required>

        <button type="submit">Save</button>
    </form>
  </div>
</div>
<?php } 

/* if (isset($_POST['insertEC'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="closeForm()">&times;</span>
    <h2>Register New PPAP</h2>
    <form action="?page=Cables" method="post">
        <input type="hidden" name="confirmIEC" value="1">
        <label>Eurotech PN:</label>
        <select name="Eurotech_PN_CAB" id="" required>
            <option value=""></option>
            <?php foreach ($ETPNS as $ETPN) {  ?>
                <option value="<?php echo $ETPN['Eurotech_PN_CAB'] ?>"><?php echo $ETPN['Eurotech_PN_CAB'] ?></option>
            <?php }?>
        </select> <br>
        <!-- <input type="text" name="Eurotech_PN_CAB" list="ETPN">
        <datalist id="ETPN">
            <?php // foreach ($ETPNS as $ETPN) {  ?>
                <option value="<?php // echo $ETPN['Eurotech_PN_CAB'] ?>">
            <?php // } ?>
        </datalist> <br> -->

        <label>Customer:</label>
        <select name="Eurotech_PN_CAB" id="" required>
            <option value=""></option>
            <?php foreach ($Customers as $Customer) {  ?>
                <option value="<?php echo $Customer['Name'] ?>"><?php echo $Customer['Name'] ?></option>
            <?php }?>
        </select> <br>
        <!-- <input type="text" name="Name" list="Cust">
        <datalist id="Cust">
            <?php // oreach ($Customers as $Customer) {  ?>
                <option value="<?php echo $Customer['Name'] ?>">
            <?php // } ?>
        </datalist> <br>  -->

        <label>Customer PN:</label>
        <input type="text" name="FK_CAB_Customer_PN" required> <br>

        <label>PPAP Requested Date:</label>
        <input type="date" name="PPAP_Requested_Date" id="" required>

        <button type="submit">Save</button>
    </form>
  </div>
</div>
<?php } */ ?>

<script>
    // function abrirFormulario() {
    //     document.getElementById('formularioModal').style.display = 'block';
    // }

    function closeForm() {
        document.getElementById('formularioModal').style.display = 'none';
    }

    function sendForm() {
        closeForm();
        return true;
    }

    // function cerrarModal(id) {
    //     document.getElementById(id).style.display = 'none';
    // }
</script>