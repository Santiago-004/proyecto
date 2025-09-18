<link href="./css/style.css" rel="stylesheet">
<form action="?page=Cables" method="post">
    <input type="hidden" name="insert" value="1">
    <button type="submit" class="insert">New PPAP</button>
</form>

<form action="?page=Cables" method="post">
    <input type="hidden" name="insertEC" value="1">
    <button type="submit" class="insert">New PPAP</button>
</form>

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
<?php } ?>
<?php if (isset($_POST['insert'])) { ?>
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
<?php } 

if (isset($_POST['insertEC'])) { ?>
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
            <?php /* foreach ($ETPNS as $ETPN) {  ?>
                <option value="<?php echo $ETPN['Eurotech_PN_CAB'] ?>">
            <?php } */?>
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
            <?php /*foreach ($Customers as $Customer) {  ?>
                <option value="<?php echo $Customer['Name'] ?>">
            <?php } */ ?>
        </datalist> <br>  -->

        <label>Customer PN:</label>
        <input type="text" name="FK_CAB_Customer_PN" required> <br>

        <label>PPAP Requested Date:</label>
        <input type="date" name="PPAP_Requested_Date" id="" required>

        <button type="submit">Save</button>
    </form>
  </div>
</div>
<?php } ?>

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