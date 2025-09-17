<?php
    class model {                                        

        public  $mbd;
        
        function cn() {
            $this->mbd = new PDO('mysql:host=localhost;dbname=eurotechdb;port=3306', 'root', '');
            $this->mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
    
        function search(){
            $logs = [];
            if (isset($_POST['btnsearch'])) {
                // foreach ($this->mbd->query(
                //     "WITH ultima_adopcion AS (
                //         SELECT AD.*
                //         FROM adopcion AD
                //         INNER JOIN (
                //             SELECT id_animal, MAX(fecha_solicitud) AS fecha_solicitud
                //             FROM adopcion
                //             GROUP BY id_animal
                //         ) ult ON AD.id_animal = ult.id_animal AND AD.fecha_solicitud = ult.fecha_solicitud
                //     )

                //     SELECT A.id_animal AS id, A.*, AD.*, D.*
                //     FROM animal A
                //     LEFT JOIN ultima_adopcion AD ON A.id_animal = AD.id_animal
                //     LEFT JOIN dueño D ON D.id_dueño = AD.id_dueño
                //     WHERE A.con_dueño = 'N'
                //     AND (
                //         AD.estado IS NULL
                //         OR (AD.estado IN ('pendiente', 'cancelado') AND D.id_usuario = ".$_SESSION['id_usuario'].")
                //         OR (AD.estado = 'cancelado' AND D.id_usuario != ".$_SESSION['id_usuario'].")
                //     ) AND especie LIKE '".$_POST['txtbuscar']."%'
                //     ORDER BY A.nombre ASC"
                // ) as $log) {
                //     $logs[] = $log;
                // }
            } else {
                foreach ($this->mbd->query(
                    "SELECT 
                        if(Sent_Customer IS NULL, datediff(NOW(), PPAP_Req_by_Cus_Date), datediff(Sent_Customer, PPAP_Req_by_Cus_Date)) AS 'Days to Submit',
                        tp.PPAP_Number,
                        tps.PPAP_Req_by_Cus_Date,
                        tps.Current_Status,
                        tp.Vendor,
                        tc.`Name`,
                        tcc.Country,
                        tcp.TUB_Customer_PN,
                        t.ET_Model,
                        t.ET_Dwg,
                        tps.Rev,
                        t.Eurotech_PN_TUB,
                        t.`Description`,
                        tps.IMDS_Number,
                        tps.IMDS_Status,
                        tps.PPAP_do,
                        tps.`Level`,
                        tps.Samples_Status,
                        tps.Reason_submission,
                        tps.Sent_Customer,
                        tps.PSW_Returned,
                        tps.Origin_from_report,
                        tps.Comments,
                        tps.Inspection_rep_numb
                    FROM tubes_ppaps tps
                        INNER JOIN tubes_ppap tp ON tps.FK_PPAP_Number = tp.PPAP_Number
                        INNER JOIN tubes_customer_pn tcp ON tps.FK_TUB_Customer_PN = tcp.TUB_Customer_PN
                        INNER JOIN tubes_customers tc ON tp.FK_ID_TUB_Customer = tc.ID_TUB_Customer
                        INNER JOIN `tubes_customer-country` tcc ON tp.`FK_TUB_Customer-Country` = tcc.`TUB_Customer-Country`
                        INNER JOIN tubes t ON tcp.FK_Eurotech_PN_TUB = t.Eurotech_PN_TUB
                    ORDER BY `Days to Submit`;"
                ) as $log) {
                    $logs[] = $log;
                }
            }
            return $logs;
        }
    }
?>