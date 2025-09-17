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
                        tp.ID_TAP_PPAP,
                        tc.`Name`,
                        tp.PPAP_level,
                        t.SAP_Number,
                        tp.FK_TAP_Customer_PN,
                        t.Tape,
                        t.Width,
                        t.`Length`,
                        t.Color,
                        tp.IMDS_ID_No,
                        tp.`Returned_CTC-Sent_Cust`,
                        tp.`Cust_Signed-Sent_CTC`,
                        -- tr.Renewal_Date,
                        -- tr.Send_Request_CTC,
                        -- tr.Sent_Customer,
                        -- tr.Returned_Cust_Signed,
                        tp.PPAP_from_shipments,
                        tp.Comments
                    FROM tapes_ppap tp
                        INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN  = tcp.TAP_Customer_PN
                        INNER JOIN tapes_customers tc ON tcp.FK_ID_TAP_Customer = tc.ID_TAP_Customer
                        INNER JOIN tapes t ON tcp.FK_Eurotech_PN_TAP = t.Eurotech_PN_TAP
                        -- LEFT JOIN tapes_renewal tr ON tp.ID_TAP_PPAP = tr.FK_ID_TAP_PPAP
                        ;"
                ) as $log) {
                    $logs[] = $log;
                }
            }
            return $logs;
        }

        function searchRenew24($ID){
            $Renewlogs24 = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        tr.Renewal_Date,
                        tr.Send_Request_CTC,
                        tr.Sent_Customer,
                        tr.Returned_Cust_Signed,
                        tr.FK_ID_TAP_PPAP,
                        tp.ID_TAP_PPAP,
                        YEAR(tr.Renewal_Date) AS 'Year',
                        YEAR(tr.Sent_Customer) AS 'Year2'
                    FROM tapes_ppap tp
                        LEFT JOIN tapes_renewal tr ON tp.ID_TAP_PPAP = tr.FK_ID_TAP_PPAP
                    WHERE tp.ID_TAP_PPAP = $ID
                    HAVING `Year` = 2024 OR `Year2` = 2024;"
                ) as $Renewlog24) {
                    $Renewlogs24[] = $Renewlog24;
                }
            return $Renewlogs24;
        }

        function searchRenew25($ID){
            $Renewlogs25 = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        tr.Renewal_Date,
                        tr.Send_Request_CTC,
                        tr.Sent_Customer,
                        tr.Returned_Cust_Signed,
                        tr.FK_ID_TAP_PPAP,
                        tp.ID_TAP_PPAP,
                        YEAR(tr.Renewal_Date) AS 'Year',
                        YEAR(tr.Sent_Customer) AS 'Year2'
                    FROM tapes_ppap tp
                        LEFT JOIN tapes_renewal tr ON tp.ID_TAP_PPAP = tr.FK_ID_TAP_PPAP
                    WHERE tp.ID_TAP_PPAP = $ID
                    HAVING `Year` = 2025 OR `Year2` = 2025;"
                ) as $Renewlog25) {
                    $Renewlogs25[] = $Renewlog25;
                }
            return $Renewlogs25;
        }
    }
?>