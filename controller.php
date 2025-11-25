<?php 
    include "model.php";

    $model = new model();
    $model->cn();
    $logs = [];
    
    if (isset($_POST["idsearch"])){
        $idsearch = $_POST["idsearch"];
    }    
    else {
        $idsearch = NULL;
    }

    if (isset($_POST["custsearch"])){
        $custsearch = $_POST["custsearch"];
    }    
    else {
        $custsearch = NULL;
    }

    if (isset($_POST["counsearch"])){
        $counsearch = $_POST["counsearch"];
    }    
    else {
        $counsearch = NULL;
    }

    if (isset($_POST["etpnsearch"])){
        $etpnsearch = $_POST["etpnsearch"];
    }    
    else {
        $etpnsearch = NULL;
    }

    $cpnData = NULL;
    $cpnDataD = NULL;
    $Deleted = NULL;

    $pdo = new PDO("mysql:host=localhost;dbname=eurotechdb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['confirmI'])) {
            $stmt = $pdo->prepare("SELECT `Name` FROM customers WHERE `Name` = ?");
            $stmt->execute([
                $_POST['Name']
            ]);
            $custname = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if($custname != NULL) {
                if($_POST['Country'] != "") {
                    $stmt = $pdo->prepare("SELECT C_ID FROM customers WHERE `Name` = ? AND Country = ?");
                    $stmt->execute([
                        $_POST['Name'],
                        $_POST['Country']
                    ]);
                    $customer = $stmt->fetchAll(PDO::FETCH_COLUMN);
                }
                else {
                    $stmt = $pdo->prepare("SELECT C_ID FROM customers WHERE `Name` = ? AND Country IS NULL");
                    $stmt->execute([
                        $_POST['Name']
                    ]);
                    $customer = $stmt->fetchAll(PDO::FETCH_COLUMN);
                } 
                
                if($customer != NULL) {
                    $stmt = $pdo->prepare("SELECT Eurotech_PN FROM products WHERE Eurotech_PN = ?");
                    $stmt->execute([
                        $_POST['Eurotech_PN']
                    ]);
                    $etpn = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    if($etpn != NULL) {
                        $stmt = $pdo->prepare("SELECT Customer_PN FROM customer_pn cpn
                                                INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                                                INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                                                WHERE C_ID = ? AND Eurotech_PN = ?");
                        $stmt->execute([
                            $customer[0],
                            $_POST['Eurotech_PN']
                        ]);
                        $cce = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        if($cce != NULL) {
                            $_POST['insert'] = 1;
                            if($_POST['Country'] != "") {
                                $error = "A Customer PN already exists for the Eurotech PN <b>".$_POST['Eurotech_PN']."</b> and the customer <b>".$_POST['Name']."</b> - <b>".$_POST['Country']."</b>.";
                            }
                            else {
                                $error = "A Customer PN already exists for the Eurotech PN <b>".$_POST['Eurotech_PN']."</b> and the customer <b>".$_POST['Name']."</b>.";
                            }
                        }
                        else {
                            $stmt = $pdo->prepare("SELECT Customer_PN FROM customer_pn cpn
                                                    INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                                                    INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                                                    WHERE C_ID = ? AND Customer_PN = ? AND Eurotech_PN != ?");
                            $stmt->execute([
                                $customer[0],
                                $_POST['Customer_PN'],
                                $_POST['Eurotech_PN']
                            ]);
                            $cpn = $stmt->fetchAll(PDO::FETCH_COLUMN);

                            if($cpn != NULL) {
                                $_POST['insert'] = 1;
                                if($_POST['Country'] != "") {
                                    $error = "You are duplicating the Customer PN <b>".$_POST['Customer_PN']."</b> for the customer <b>".$_POST['Name']."</b> - <b>".$_POST['Country']."</b>.";
                                }
                                else {
                                    $error = "You are duplicating the Customer PN <b>".$_POST['Customer_PN']."</b> for the customer <b>".$_POST['Name']."</b>.";
                                }
                            }
                            else {
                                    if(!isset($error)) {
                                            $stmt = $pdo->prepare("INSERT INTO customer_pn (Customer_PN, FK_Customer_ID, FK_Eurotech_PN) 
                                                                    VALUES (?, ?, ?)");
                                            $stmt->execute([
                                                $_POST['Customer_PN'],
                                                $customer[0],
                                                $etpn[0]
                                            ]);
                                    }
                            }
                        }
                    }
                    else {
                        $_POST['insert'] = 1;
                        $error = "The Eurotech PN <b>".$_POST['Eurotech_PN']."</b> doesn't exist.";
                    }                    
                }
                else {
                    $_POST['insert'] = 1;
                    if($_POST['Country'] != NULL) {
                        $error = "The customer <b>".$_POST['Name']."</b> - <b>".$_POST['Country']."</b> doesn't exist.";
                    }
                    else {
                        $error = "The customer <b>".$_POST['Name']."</b> doesn't exist.";
                    }
                }   
            }
            else {
                $_POST['insert'] = 1;
                $error = "The customer <b>".$_POST['Name']."</b> doesn't exist.";
            }

            $_SESSION['saved'] = true;
        }

        if (isset($_POST['edit'])) {
            $id = $_POST['IDedit'];
            $stmt = $pdo->prepare("SELECT * FROM customer_pn cpn
                INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                WHERE Customer_PN_ID = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $cpnData = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['confirmU'])) {
            $stmt = $pdo->prepare("SELECT `Name` FROM customers WHERE `Name` = ?");
            $stmt->execute([
                $_POST['Name']
            ]);
            $custname = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if($custname != NULL) {
                if($_POST['Country'] != "") {
                    $stmt = $pdo->prepare("SELECT C_ID FROM customers WHERE `Name` = ? AND Country = ?");
                    $stmt->execute([
                        $_POST['Name'],
                        $_POST['Country']
                    ]);
                    $customer = $stmt->fetchAll(PDO::FETCH_COLUMN);
                }
                else {
                    $stmt = $pdo->prepare("SELECT C_ID FROM customers WHERE `Name` = ? AND Country IS NULL");
                    $stmt->execute([
                        $_POST['Name']
                    ]);
                    $customer = $stmt->fetchAll(PDO::FETCH_COLUMN);
                } 
                
                if($customer != NULL) {
                    $stmt = $pdo->prepare("SELECT Eurotech_PN FROM products WHERE Eurotech_PN = ?");
                    $stmt->execute([
                        $_POST['Eurotech_PN']
                    ]);
                    $etpn = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    if($etpn != NULL) {
                        $stmt = $pdo->prepare("SELECT Customer_PN FROM customer_pn cpn
                                                INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                                                INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                                                WHERE C_ID = ? AND Eurotech_PN = ? AND Customer_PN_ID != ?");
                        $stmt->execute([
                            $customer[0],
                            $_POST['Eurotech_PN'],
                            $_POST['Customer_PN_ID']
                        ]);
                        $cce = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        if($cce != NULL) {
                            $_POST['edit'] = 1;
                            if($_POST['Country'] != "") {
                                $error = "A Customer PN already exists for the Eurotech PN <b>".$_POST['Eurotech_PN']."</b> and the customer <b>".$_POST['Name']."</b> - <b>".$_POST['Country']."</b>.";
                            }
                            else {
                                $error = "A Customer PN already exists for the Eurotech PN <b>".$_POST['Eurotech_PN']."</b> and the customer <b>".$_POST['Name']."</b>.";
                            }
                        }
                        else {
                            $stmt = $pdo->prepare("SELECT Customer_PN FROM customer_pn cpn
                                                    INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                                                    INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                                                    WHERE C_ID = ? AND Customer_PN = ? AND Eurotech_PN != ? AND Customer_PN_ID != ?");
                            $stmt->execute([
                                $customer[0],
                                $_POST['Customer_PN'],
                                $_POST['Eurotech_PN'],
                                $_POST['Customer_PN_ID']
                            ]);
                            $cpn = $stmt->fetchAll(PDO::FETCH_COLUMN);

                            if($cpn != NULL) {
                                $_POST['edit'] = 1;
                                if($_POST['Country'] != "") {
                                    $error = "You are duplicating the Customer PN <b>".$_POST['Customer_PN']."</b> for the customer <b>".$_POST['Name']."</b> - <b>".$_POST['Country']."</b>.";
                                }
                                else {
                                    $error = "You are duplicating the Customer PN <b>".$_POST['Customer_PN']."</b> for the customer <b>".$_POST['Name']."</b>.";
                                }
                            }
                            else {
                                    if(!isset($error)) {
                                            $stmt = $pdo->prepare("UPDATE customer_pn SET 
                                                                        Customer_PN = ?, 
                                                                        FK_Customer_ID = ?, 
                                                                        FK_Eurotech_PN = ? 
                                                                    WHERE Customer_PN_ID = ?");
                                            $stmt->execute([
                                                $_POST['Customer_PN'],
                                                $customer[0],
                                                $_POST['Eurotech_PN'],
                                                $_POST['Customer_PN_ID']
                                            ]);
                                    }
                            }
                        }
                    }
                    else {
                        $_POST['edit'] = 1;
                        $error = "The Eurotech PN <b>".$_POST['Eurotech_PN']."</b> doesn't exist.";
                    }                    
                }
                else {
                    $_POST['edit'] = 1;
                    if($_POST['Country'] != NULL) {
                        $error = "The customer <b>".$_POST['Name']."</b> - <b>".$_POST['Country']."</b> doesn't exist.";
                    }
                    else {
                        $error = "The customer <b>".$_POST['Name']."</b> doesn't exist.";
                    }
                }   
            }
            else {
                $_POST['edit'] = 1;
                $error = "The customer <b>".$_POST['Name']."</b> doesn't exist.";
            }
            
           
            $_SESSION['saved'] = true;
        }

        if (isset($_POST['delete'])) {
            $id = $_POST['IDdelete'];
            $stmt = $pdo->prepare("SELECT * FROM customer_pn cpn
                INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                WHERE Customer_PN_ID = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $cpnDataD = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['confirmD'])) {
            $id = $_POST['Customer_PN_ID'];
            $stmt = $pdo->prepare("SELECT FK_Customer_PN_ID FROM ppap
                                    WHERE FK_Customer_PN_ID = ?");
            $stmt->execute([$id]);
            $cpn = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if($cpn == NULL) {
                $stmt = $pdo->prepare("DELETE FROM customer_pn
                                        WHERE Customer_PN_ID = ?");

                $stmt->execute([$id]);
            
                $Deleted = 'Y';
            }
            else {
                $_POST['delete'] = 1;
                $error = "This customer PN can't be deleted, because it already has registers.";

                $stmt = $pdo->prepare("SELECT * FROM customer_pn cpn
                                        INNER JOIN customers c ON cpn.FK_Customer_ID = c.C_ID
                                        INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
                                        WHERE Customer_PN_ID = ?");
                $stmt->execute([$id]);

                if ($stmt->rowCount() > 0) {
                    $cpnDataD = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }

            $_SESSION['saved'] = true;
        }
    }
    
    
    $CPNs = $model->searchCPN();
    $Customers = $model->searchCustomers();
    $Countries = $model->searchCountries();
    $ETPNs = $model->searchETPNs();
    $logs = $model->search();

    include 'view.php';
?>