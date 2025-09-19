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
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" &&  $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" &&  $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" &&  $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" &&  $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                // 
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] != "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Name` = '".$_POST['custsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] != "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE Eurotech_PN_CAB = '".$_POST['etpnsearch']."'
                            AND `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] != "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE `Description` = '".$_POST['descsearch']."'
                            AND PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] != "" && $_POST['date2search'] != "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE PPAP_Requested_Date BETWEEN '".$_POST['date1search']."' AND '".$_POST['date2search']."'
                            AND PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] != "" && $_POST['date4search'] != "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE PPAP_Signed_Date BETWEEN '".$_POST['date3search']."' AND '".$_POST['date4search']."'
                            AND CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
                
                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] != "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            WHERE CAB_Customer_PN = ".$_POST['cpnsearch']."
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }

                if($_POST['custsearch'] == "" && $_POST['etpnsearch'] == "" && $_POST['copnsearch'] == "" && $_POST['cpnsearch'] == "" && $_POST['descsearch'] == "" && ($_POST['date1search'] == "" || $_POST['date2search'] == "") && ($_POST['date3search'] == "" || $_POST['date4search'] == "")){
                    foreach ($this->mbd->query(
                        "SELECT 
                            Eurotech_PN_CAB,
                            Coroflex_PN,
                            CAB_Customer_PN, 
                            `Description`,
                            PPAP_Requested_Date,
                            PPAP_Received_Date,
                            PPAP_Sent_Date,
                            PPAP_Signed_Date,
                            `Name`
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer 
                            ORDER BY Eurotech_PN_CAB;"
                    ) as $log) {
                        $logs[] = $log;
                    }
                }
            } else {
                foreach ($this->mbd->query(
                    "SELECT  
                        Eurotech_PN_CAB,
                        Coroflex_PN,
                        CAB_Customer_PN, 
                        `Description`,
                        PPAP_Requested_Date,
                        PPAP_Received_Date,
                        PPAP_Sent_Date,
                        PPAP_Signed_Date,
                        `Name`
                    FROM cables ca
                        LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                        LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                        LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer
                    ORDER BY Eurotech_PN_CAB;"
                ) as $log) {
                    $logs[] = $log;
                }
            }
            return $logs;
        }

        function searchCustomers(){
            $Customers = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        ID_CAB_Customer,
                        `Name`
                    FROM cables_customer
                    ORDER BY `Name`;"
                ) as $Customer) {
                    $Customers[] = $Customer;
                }
            return $Customers;
        }

        function searchETPN(){
            $ETPNS = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        Eurotech_PN_CAB
                    FROM cables
                    ORDER BY Eurotech_PN_CAB;"
                ) as $ETPN) {
                    $ETPNS[] = $ETPN;
                }
            return $ETPNS;
        }

        function searchCOPN(){
            $COPNS = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        Coroflex_PN
                    FROM cables
                    ORDER BY Coroflex_PN;"
                ) as $COPN) {
                    $COPNS[] = $COPN;
                }
            return $COPNS;
        }

        function searchCPN(){
            $CPNS = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        CAB_Customer_PN
                    FROM cables_customer_pn
                    ORDER BY CAB_Customer_PN;"
                ) as $CPN) {
                    $CPNS[] = $CPN;
                }
            return $CPNS;
        }

        function searchDesc(){
            $Descs = [];
                foreach ($this->mbd->query(
                    "SELECT 
                        `Description`
                    FROM cables
                    ORDER BY `Description`;"
                ) as $Desc) {
                    $Descs[] = $Desc;
                }
            return $Descs;
        }
    }
?>