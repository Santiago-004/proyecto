<?php 
    include "model.php";

    $model = new model();
    $model->cn();
    $logs = [];
    
    if (isset($_POST["txtsearch"])){
        $txtsearch = $_POST["txtsearch"];
    }    
    else {
        $txtsearch ="";
    }
    
    $pdo = new PDO("mysql:host=localhost;dbname=eurotechdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['confirmI'])) {
            $stmt = $pdo->prepare("INSERT INTO cables_ppap (FK_CAB_Customer_PN, PPAP_Requested_Date) 
                                        VALUES (?, ?)");
            $stmt->execute([
                $_POST['CAB_Customer_PN'],
                $_POST['PPAP_Requested_Date']
            ]);
            $_SESSION['saved'] = true;
        }

        if (isset($_POST['confirmIEC'])) {
            $stmt = $pdo->prepare("SELECT ID_CAB_Customer FROM cables_customer WHERE `Name` = ?");
            $stmt->execute([
                $_POST['Name']
            ]);

            $cust = $stmt->fetchAll(PDO::FETCH_COLUMN);

            //  var_dump($cust);

            foreach ($cust as $idCust) {
                $stmt2 = $pdo->prepare("INSERT INTO cables_customer_pn (CAB_Customer_PN, FK_Eurotech_PN_CAB, FK_ID_CAB_Customer) 
                                            VALUES (?, ?, ?)");
                $stmt2->execute([
                    $_POST['FK_CAB_Customer_PN'],
                    $_POST['Eurotech_PN_CAB'],
                    $idCust
                ]);
            }

            $stmt3 = $pdo->prepare("INSERT INTO cables_ppap (FK_CAB_Customer_PN, PPAP_Requested_Date) 
                                            VALUES (?, ?)");
            $stmt3->execute([
                $_POST['FK_CAB_Customer_PN'],
                $_POST['PPAP_Requested_Date']
            ]);
            $_SESSION['saved'] = true;
        }
    }

    $Customers = $model->searchCustomers();
    $ETPNS = $model->searchETPN();
    $CPNS = $model->searchCPN();
    $logs = $model->search();

    include 'view.php';
?>