<?php 
    include "model.php";

    $model = new model();
    $model->cn();
    $logs = [];
    
    if (isset($_POST["custsearch"])){
        $custsearch = $_POST["custsearch"];
    }    
    else {
        $custsearch = "";
    }

    if (isset($_POST["etpnsearch"])){
        $etpnsearch = $_POST["etpnsearch"];
    }    
    else {
        $etpnsearch = "";
    }

    if (isset($_POST["copnsearch"])){
        $copnsearch = $_POST["copnsearch"];
    }    
    else {
        $copnsearch = "";
    }

    if (isset($_POST["cpnsearch"])){
        $cpnsearch = $_POST["cpnsearch"];
    }    
    else {
        $cpnsearch = "";
    }

    if (isset($_POST["descsearch"])){
        $descsearch = $_POST["descsearch"];
    }    
    else {
        $descsearch = "";
    }

    if (isset($_POST["date1search"]) && isset($_POST["date2search"])){
        $date1search = $_POST["date1search"];
        $date2search = $_POST["date2search"];
    }    
    else {
        $date1search = "";
        $date2search = "";
    }

    if (isset($_POST["date3search"]) && isset($_POST["date4search"])){
        $date3search = $_POST["date3search"];
        $date4search = $_POST["date4search"];
    }    
    else {
        $date3search = "";
        $date4search = "";
    }

    if (isset($_POST["date5search"]) && isset($_POST["date6search"])){
        $date5search = $_POST["date5search"];
        $date6search = $_POST["date6search"];
    }    
    else {
        $date5search = "";
        $date6search = "";
    }

    if (isset($_POST["date7search"]) && isset($_POST["date8search"])){
        $date7search = $_POST["date7search"];
        $date8search = $_POST["date8search"];
    }    
    else {
        $date7search = "";
        $date8search = "";
    }

    $pdo = new PDO("mysql:host=localhost;dbname=eurotechdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // if (isset($_POST['confirmI'])) {
        //     $stmt = $pdo->prepare("INSERT INTO cables_ppap (FK_CAB_Customer_PN, PPAP_Requested_Date) 
        //                                 VALUES (?, ?)");
        //     $stmt->execute([
        //         $_POST['CAB_Customer_PN'],
        //         $_POST['PPAP_Requested_Date']
        //     ]);
        //     $_SESSION['saved'] = true;
        // }

        if (isset($_POST['confirmI'])) {
            $stmt = $pdo->prepare("SELECT Eurotech_PN_CAB FROM cables WHERE `Description` = ?");
            $stmt->execute([
                $_POST['Description']
            ]);
            $etpn = $stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($etpn as $pn) {
                $stmt2 = $pdo->prepare("SELECT CAB_Customer_PN FROM cables_customer_pn WHERE FK_Eurotech_PN_CAB = ? AND FK_ID_CAB_Customer = ?");
                $stmt2->execute([
                    $pn,
                    $_POST['ID_CAB_Customer']
                ]);
                $cpn = $stmt2->fetchAll(PDO::FETCH_COLUMN);
            }

            foreach ($cpn as $pn) {
                 $stmt = $pdo->prepare("INSERT INTO cables_ppap (FK_CAB_Customer_PN, PPAP_Requested_Date) 
                                        VALUES (?, ?)");
                $stmt->execute([
                    $pn,
                    $_POST['PPAP_Requested_Date']
                ]);
            }
           
            $_SESSION['saved'] = true;
        }

        // if (isset($_POST['confirmIEC'])) {
        //     $stmt = $pdo->prepare("SELECT ID_CAB_Customer FROM cables_customer WHERE `Name` = ?");
        //     $stmt->execute([
        //         $_POST['Name']
        //     ]);

        //     $cust = $stmt->fetchAll(PDO::FETCH_COLUMN);

        //     //  var_dump($cust);

        //     foreach ($cust as $idCust) {
        //         $stmt2 = $pdo->prepare("INSERT INTO cables_customer_pn (CAB_Customer_PN, FK_Eurotech_PN_CAB, FK_ID_CAB_Customer) 
        //                                     VALUES (?, ?, ?)");
        //         $stmt2->execute([
        //             $_POST['FK_CAB_Customer_PN'],
        //             $_POST['Eurotech_PN_CAB'],
        //             $idCust
        //         ]);
        //     }

        //     $stmt3 = $pdo->prepare("INSERT INTO cables_ppap (FK_CAB_Customer_PN, PPAP_Requested_Date) 
        //                                     VALUES (?, ?)");
        //     $stmt3->execute([
        //         $_POST['FK_CAB_Customer_PN'],
        //         $_POST['PPAP_Requested_Date']
        //     ]);
        //     $_SESSION['saved'] = true;
        // }
    }

    $Customers = $model->searchCustomers();
    $ETPNS = $model->searchETPN();
    $COPNS = $model->searchCOPN();
    $CPNS = $model->searchCPN();
    $Descs = $model->searchDesc();
    $logs = $model->search();
    

    include 'view.php';
?>