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
                        b.Model,
                        b.`Description`,
                        bc.`Name`,
                        bcp.BS_Customer_PN,
                        bp.IMDS,
                        b.Supplier,
                        b.Supplier_PN,
                        bp.Request_Date,
                        bp.Sent_Customer
                    FROM bluseal b
                        LEFT JOIN bluseal_customer_pn bcp ON b.BS_Eurotech_PN = bcp.FK_BS_Eurotech_PN
                        LEFT JOIN bluseal_customer bc ON bcp.FK_ID_BS_Customer = bc.ID_BS_Customer
                        LEFT JOIN bluseal_ppap bp ON bcp.BS_Customer_PN = bp.FK_BS_Customer_PN;"
                ) as $log) {
                    $logs[] = $log;
                }
            }
            return $logs;
        }
    }
?>