-- /// BLUSEAL PPAP ///
SELECT 
	b.Model,
	b.`Description`,
	bc.`Name` AS 'Customer',
	bcp.BS_Customer_PN AS 'Customer PN',
	bp.IMDS,
	b.Supplier,
	b.Supplier_PN AS 'Supplier PN',
	bp.Request_Date AS 'Request Date',
	bp.Sent_Customer AS 'Sent to Customer'
FROM bluseal b
	LEFT JOIN bluseal_customer_pn bcp ON b.BS_Eurotech_PN = bcp.FK_BS_Eurotech_PN
	LEFT JOIN bluseal_customer bc ON bcp.FK_ID_BS_Customer = bc.ID_BS_Customer
	LEFT JOIN bluseal_ppap bp ON bcp.BS_Customer_PN = bp.FK_BS_Customer_PN;
	
-- /// CABLES PPAP ///
SELECT  
	Eurotech_PN_CAB AS 'Eurotech PN',
	Coroflex_PN AS 'Coroflex PN',
	CAB_Customer_PN AS 'Customer PN', 
	`Description`,
	PPAP_Requested_Date AS 'PPAP Requested',
	PPAP_Signed_Date AS 'Signed Date',
	`Name` AS 'Customer'
FROM cables ca
	LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
	LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
	LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer;
 
-- /// CINTAS PPAPs Missing
SELECT 
	`Date`, 
	`Name` AS 'CUS',
	FK_TAP_Customer_PN AS 'CUS PN',
	`Description` AS 'TAPE',
	CTC,
	Form_Sent_Cust AS 'Form sent CUS',
	Reminder,
	`Received-RQ_Sent_CTC` AS 'Received/RQ sent CTC',
	Closing_Date AS 'Closing Date',
	Comments
FROM tapes_ppap_missing tpm
	INNER JOIN tapes_customer_pn tcp ON tpm.FK_TAP_Customer_PN = tcp.TAP_Customer_PN
	INNER JOIN tapes_customers tc ON tcp.FK_ID_TAP_Customer = tc.ID_TAP_Customer
	INNER JOIN tapes t ON tcp.FK_Eurotech_PN_TAP = t.Eurotech_PN_TAP;
 
 
-- /// CINTAS PPAP
SELECT 
	tp.ID_TAP_PPAP,
	tc.`Name` AS 'CUSTOMER',
	tp.PPAP_level AS 'PPAP Level',
	t.SAP_Number AS 'SAP No.',
	tp.FK_TAP_Customer_PN AS 'Customer Part No.',
	t.Tape,
	t.Width AS 'Width (MM)',
	t.`Length` AS 'Length (M)',
	t.Color,
	tp.IMDS_ID_No AS 'IMDS ID no.',
	tp.`Returned_CTC-Sent_Cust` AS 'Returned from CTC / Sent to Customer',
	tp.`Cust_Signed-Sent_CTC` AS 'PSW returned from Customer signed / Sent to CTC',
	tr.Renewal_Date AS 'Renewal Date',
	tr.Send_Request_CTC AS 'When to send Request to CTC',
	tr.Sent_Customer AS 'Sent to Customer',
	tr.Returned_Cust_Signed AS 'PSW returned from Customer signed',
	tp.PPAP_from_shipments AS 'PPAP from shipments',
	tp.Comments,
	YEAR(tr.Renewal_Date) AS 'Year',
	YEAR(tr.Sent_Customer) AS 'Year2'
FROM tapes_ppap tp
	INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN  = tcp.TAP_Customer_PN
	INNER JOIN tapes_customers tc ON tcp.FK_ID_TAP_Customer = tc.ID_TAP_Customer
	INNER JOIN tapes t ON tcp.FK_Eurotech_PN_TAP = t.Eurotech_PN_TAP
	LEFT JOIN tapes_renewal tr ON tp.ID_TAP_PPAP = tr.FK_ID_TAP_PPAP;
	
SELECT 
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
WHERE tp.ID_TAP_PPAP = 4
HAVING `Year` = 2024 OR `Year2` = 2024;

SELECT 
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
WHERE tp.ID_TAP_PPAP = 4
HAVING `Year` = 2025 OR `Year2` = 2025;

 
 
-- /// TUBOS PPAP
SELECT 
	if(Sent_Customer IS NULL, datediff(NOW(), PPAP_Req_by_Cus_Date), datediff(Sent_Customer, PPAP_Req_by_Cus_Date)) AS 'Days to Submit',
	tp.PPAP_Number AS 'PPAP Number',
	tps.PPAP_Req_by_Cus_Date AS `PPAP Req'd by Customer`,
	tps.Current_Status AS 'Current Status',
	tp.Vendor AS 'PPAP/IMDS from',
	tc.`Name` AS 'CUSTOMER',
	tcc.Country,
	tcp.TUB_Customer_PN AS 'Customer PN',
	t.ET_Model AS 'ET Model',
	t.ET_Dwg AS 'ET Dwg',
	tps.Rev,
	t.Eurotech_PN_TUB AS 'ET PN',
	t.`Description`,
	tps.IMDS_Number AS 'IMDS Number',
	tps.IMDS_Status AS 'IMDS Status',
	tps.PPAP_do AS 'PPAP_do',
	tps.`Level`,
	tps.Samples_Status AS 'PPAP samples status',
	tps.Reason_submission AS 'Reason of Submission',
	tps.Sent_Customer AS 'Sent to Customer',
	tps.PSW_Returned AS 'PSW returned from Cust Signed',
	tps.Origin_from_report AS 'Origin from report',
	tps.Comments,
	tps.Inspection_rep_numb AS 'Inspection Report Number'
FROM tubes_ppaps tps
	INNER JOIN tubes_ppap tp ON tps.FK_PPAP_Number = tp.PPAP_Number
	INNER JOIN tubes_customer_pn tcp ON tps.FK_TUB_Customer_PN = tcp.TUB_Customer_PN
	INNER JOIN tubes_customers tc ON tp.FK_ID_TUB_Customer = tc.ID_TUB_Customer
	INNER JOIN `tubes_customer-country` tcc ON tp.`FK_TUB_Customer-Country` = tcc.`TUB_Customer-Country`
	INNER JOIN tubes t ON tcp.FK_Eurotech_PN_TUB = t.Eurotech_PN_TUB;
	
	
SELECT Eurotech_PN_CAB, Coroflex_PN, CAB_Customer_PN, `Description`, PPAP_Requested_Date, PPAP_Signed_Date,
                            `Name`,
                            ID_CAB_Customer
                        FROM cables ca
                            LEFT JOIN cables_customer_pn ccp ON ccp.FK_Eurotech_PN_CAB = ca.Eurotech_PN_CAB
                            LEFT JOIN cables_ppap p ON ccp.CAB_Customer_PN = p.FK_CAB_Customer_PN
                            LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer
                           WHERE PPAP_Requested_Date BETWEEN '2024-12-09' AND '2024-12-11'
                           
                
					 
SELECT 
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
                         WHERE PPAP_Requested_Date IS NULL
                        ORDER BY Eurotech_PN_CAB;
								           
SELECT DISTINCT tp.TAP_PPAP_ID, YEAR(MAX(tr.Renewal_Date)) FROM tapes_ppap tp 
INNER JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
GROUP BY tp.TAP_PPAP_ID;

SELECT tr.Sent_Customer, tr.Returned_Cust_Signed FROM tapes_renewal tr
WHERE YEAR(tr.Renewal_Date) = 2025
AND tr.FK_TAP_PPAP_ID = 5
;

SELECT
   tp.TAP_PPAP_ID,
   tp.FK_TAP_Customer_PN
FROM tapes_ppap tp
   LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
WHERE tr.TAP_Renewal_ID IS NULL 

SELECT  tp.TAP_PPAP_ID,
   tp.FK_TAP_Customer_PN
FROM tapes_ppap tp
   LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
WHERE tr.Renewal_Date IS NULL 

SELECT tp.TAP_PPAP_ID, tr.Renewal_Date FROM tapes_ppap tp 
INNER JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID;

SELECT DISTINCT
                        tp.TAP_PPAP_ID,
                        tp.OEM,
                        tp.Country,
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
                        tp.PPAP_from_shipments,
                        tp.Comments,
                        MAX(tr.Renewal_Date) AS 'RD',
                        MAX(tr.Sent_Request_CTC) AS 'SRC',
                        MAX(tr.Sent_Customer) AS 'SC',
                        MAX(tr.Returned_Cust_Signed) AS 'RCS'
                    FROM tapes_ppap tp
                        INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN  = tcp.TAP_Customer_PN
                        INNER JOIN tapes_customer tc ON tcp.FK_TAP_Customer_ID = tc.TAP_Customer_ID
                        INNER JOIN tapes t ON tcp.FK_TAP_Eurotech_PN = t.TAP_Eurotech_PN
                        LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                         GROUP BY tp.TAP_PPAP_ID
                    ORDER BY `Name`;
                    
                    SELECT * FROM tapes_renewal tr
                        RIGHT JOIN tapes_ppap tp ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID AND (Year(tr.Renewal_Date) = 2025 OR Year(tr.Sent_Request_CTC) = 2025 OR Year(tr.Sent_Customer) = 2025)
                        INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN  = tcp.TAP_Customer_PN
                        INNER JOIN tapes_customer tc ON tcp.FK_TAP_Customer_ID = tc.TAP_Customer_ID
                        INNER JOIN tapes t ON tcp.FK_TAP_Eurotech_PN = t.TAP_Eurotech_PN
                    WHERE TAP_PPAP_ID = 36
                   
                   
           SELECT tr.Renewal_Date,
                    tr.Sent_Request_CTC,
                    tr.Sent_Customer,
                    tr.Returned_Cust_Signed,
                    tr.FK_TAP_PPAP_ID,
                    tp.TAP_PPAP_ID,
                    YEAR(tr.Renewal_Date) AS 'Year',
                    YEAR(tr.Sent_Customer) AS 'Year2'
                FROM tapes_ppap tp
                    LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                WHERE tp.TAP_PPAP_ID = 20
                HAVING `Year` = 2024 OR `Year2` = 2025;
                
                SELECT 
                		MAX(YEAR(tr.Renewal_Date))
                FROM tapes_renewal tr
                
                SELECT 
                		tp.FK_TAP_Customer_PN,
                    tr.Renewal_Date, 
                    tr.Sent_Request_CTC, 
                    tr.Sent_Customer, 
                    tr.Returned_Cust_Signed 
                FROM tapes_renewal tr
                	RIGHT JOIN tapes_ppap tp ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID AND YEAR(tr.Renewal_Date) = 2025
                WHERE YEAR(tr.Renewal_Date) IS NULL
                
                SELECT DISTINCT 
                    tp.TAP_PPAP_ID, 
                    YEAR(MAX(tr.Renewal_Date)) 
                FROM tapes_ppap tp 
                    LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                GROUP BY tp.TAP_PPAP_ID;
                
                SELECT 
                        tr.Renewal_Date, 
                        tr.Sent_Request_CTC, 
                        tr.Sent_Customer, 
                        tr.Returned_Cust_Signed,
                        tr.FK_TAP_PPAP_ID
                    FROM tapes_renewal tr
                    WHERE YEAR(tr.Renewal_Date) = 2025;
            	SELECT 
                        tr.Renewal_Date, 
                        tr.Sent_Request_CTC, 
                        tr.Sent_Customer, 
                        tr.Returned_Cust_Signed ,
                        tr.FK_TAP_PPAP_ID
                    FROM tapes_renewal tr
                    WHERE YEAR(tr.Renewal_Date) IS NULL
						  
						   AND tr.FK_TAP_PPAP_ID = 5
                    
                    
                    SELECT DISTINCT 
                    tp.TAP_PPAP_ID, 
                    YEAR(MAX(tr.Renewal_Date)) 
                FROM tapes_ppap tp 
                    LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                GROUP BY tp.TAP_PPAP_ID;
                
                
                SELECT DISTINCT tp.TAP_PPAP_ID, tp.OEM, tp.Country, tc.`Name`, tp.PPAP_level, t.SAP_Number, tp.FK_TAP_Customer_PN, t.Tape, 
					 t.Width, t.`Length`, t.Color, tp.IMDS_ID_No, tp.`Returned_CTC-Sent_Cust`, tp.`Cust_Signed-Sent_CTC`, tp.PPAP_from_shipments, tp.Comments 
					 FROM tapes_ppap tp 
					 INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN = tcp.TAP_Customer_PN 
					 INNER JOIN tapes_customer tc ON tcp.FK_TAP_Customer_ID = tc.TAP_Customer_ID 
					 INNER JOIN tapes t ON tcp.FK_TAP_Eurotech_PN = t.TAP_Eurotech_PN 
					 LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID 
					 AND (YEAR(Renewal_Date) = 2025 OR YEAR(Returned_Cust_Signed) = 2025) 
					 WHERE `Name` = 'Amphenol FCI/TCS' AND Renewal_Date IS NOT NULL  ORDER BY `Name`;
					 
					 
					 
					 SELECT DISTINCT
                                tp.TAP_PPAP_ID,
                                tp.OEM,
                                tp.Country,
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
                                tp.PPAP_from_shipments,
                                tp.Comments
                            FROM tapes_ppap tp
                                INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN  = tcp.TAP_Customer_PN
                                INNER JOIN tapes_customer tc ON tcp.FK_TAP_Customer_ID = tc.TAP_Customer_ID
                                INNER JOIN tapes t ON tcp.FK_TAP_Eurotech_PN = t.TAP_Eurotech_PN
                                LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID 
                            ORDER BY `Name`;
                            
                            
                            SELECT ccpn.CAB_Customer_PN FROM cables_customer_pn ccpn
                                                INNER JOIN cables_customer cc ON ccpn.FK_CAB_Customer_ID = cc.CAB_Customer_ID
                                                WHERE ccpn.FK_CAB_Eurotech_PN = 'P500003' AND cc.`Name` = 'MSSL';
                           
                           
                           SELECT 
                        tr.Renewal_Date, 
                        tr.Sent_Request_CTC, 
                        tr.Sent_Customer, 
                        tr.Returned_Cust_Signed 
                    FROM tapes_renewal tr
                    WHERE (YEAR(tr.Renewal_Date) = 2025 OR YEAR(tr.Sent_Request_CTC) = 2025 OR YEAR(tr.Sent_Customer) = 2025) AND tr.FK_TAP_PPAP_ID = 20
                    
                    SELECT 
                    tr.Renewal_Date, 
                    tr.Sent_Request_CTC, 
                    tr.Sent_Customer, 
                    tr.Returned_Cust_Signed 
                FROM tapes_renewal tr
                WHERE YEAR(tr.Renewal_Date) IS NULL AND tr.FK_TAP_PPAP_ID = 20;
                
                SELECT *
                                        FROM tapes_renewal 
                                        WHERE FK_TAP_PPAP_ID = 16 AND (YEAR(Sent_Request_CTC) = 2025 || YEAR(Sent_Customer) = 2025 || YEAR(Returned_Cust_Signed) = 2025) AND (YEAR(Renewal_Date) = 2025 || YEAR(Renewal_Date) IS NULL) ;
                                                
                                                
                                                SELECT DISTINCT tp.TAP_PPAP_ID, tp.OEM, tp.Country, tc.`Name`, tp.PPAP_level, t.SAP_Number, tp.FK_TAP_Customer_PN, t.Tape, t.Width, t.`Length`, 
																	t.Color, tp.IMDS_ID_No, tp.`Returned_CTC-Sent_Cust`, tp.`Cust_Signed-Sent_CTC`, tp.PPAP_from_shipments, tp.Comments, Sent_Request_CTC
																FROM tapes_ppap tp INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN = tcp.TAP_Customer_PN 
																INNER JOIN tapes_customer tc ON tcp.FK_TAP_Customer_ID = tc.TAP_Customer_ID 
																INNER JOIN tapes t ON tcp.FK_TAP_Eurotech_PN = t.TAP_Eurotech_PN LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID AND (YEAR(Sent_Request_CTC) = 2024) WHERE Sent_Request_CTC IS NOT NULL ORDER BY `Name`;
																
																
																
																SELECT MIN(YEAR(Renewal_Date)) FROM tapes_renewal WHERE FK_TAP_PPAP_ID = 32;
																SELECT MAX(YEAR(Renewal_Date)) FROM tapes_renewal WHERE FK_TAP_PPAP_ID = 32;
																
																SELECT MIN(YEAR(Sent_Customer)) FROM tapes_renewal WHERE FK_TAP_PPAP_ID = 32;
																SELECT MAX(YEAR(Sent_Customer)) FROM tapes_renewal WHERE FK_TAP_PPAP_ID = 32;
																
																
																SELECT Renewal_Date FROM tapes_renewal WHERE FK_TAP_PPAP_ID = 32 AND YEAR(Renewal_Date)=2025;
																
																SELECT DISTINCT 
                    tp.TAP_PPAP_ID, 
                    YEAR(MAX(tr.Sent_Customer)) AS 'MAX'
                FROM tapes_ppap tp 
                    INNER JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                WHERE TAP_PPAP_ID = 20
                GROUP BY tp.TAP_PPAP_ID;
                
                
                SELECT 
                    tr.Renewal_Date,
                    tr.Sent_Request_CTC,
                    tr.Sent_Customer,
                    tr.Returned_Cust_Signed,
                    tr.FK_TAP_PPAP_ID,
                    tp.TAP_PPAP_ID,
                    YEAR(tr.Renewal_Date) AS 'Year',
                    YEAR(tr.Sent_Customer) AS 'Year2'
                FROM tapes_ppap tp
                    LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                WHERE tp.TAP_PPAP_ID = 36
                HAVING `Year` = 2025 OR `Year2` = 2025;
                
                 SELECT tr.FK_TAP_PPAP_ID, tr.Renewal_Date, tr.Sent_Customer FROM tapes_renewal tr;
                
                SELECT tr.FK_TAP_PPAP_ID, tr.Renewal_Date, tr.Sent_Customer FROM tapes_renewal tr WHERE tr.FK_TAP_PPAP_ID = 9 AND (YEAR(tr.Renewal_Date) = 2024 OR (YEAR(tr.Sent_Customer) = 2024 AND tr.Renewal_Date IS NULL));
                
                SELECT 
                    tr.Renewal_Date,
                    tr.Sent_Request_CTC,
                    tr.Sent_Customer,
                    tr.Returned_Cust_Signed,
                    tr.FK_TAP_PPAP_ID,
                    tp.TAP_PPAP_ID,
                    YEAR(tr.Renewal_Date) AS 'Year',
                    YEAR(tr.Sent_Customer) AS 'Year2'
                FROM tapes_ppap tp
                    LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                WHERE tp.TAP_PPAP_ID = 9
                HAVING `Year` = 2024 OR `Year2` = 2024;
                
                SELECT 
                    tr.Renewal_Date,
                    tr.Sent_Request_CTC,
                    tr.Sent_Customer,
                    tr.Returned_Cust_Signed,
                    tr.FK_TAP_PPAP_ID,
                    tp.TAP_PPAP_ID,
                    YEAR(tr.Renewal_Date) AS 'Year',
                    YEAR(tr.Sent_Customer) AS 'Year2'
                FROM tapes_ppap tp
                    LEFT JOIN tapes_renewal tr ON tp.TAP_PPAP_ID = tr.FK_TAP_PPAP_ID
                WHERE tp.TAP_PPAP_ID = 9
                HAVING `Year` = 2025 OR (`Year` IS NULL AND `Year2` = 2025);
                
                SELECT COUNT(DISTINCT FK_PPAP_Number) AS 'PPAP_Number_Count' FROM tubes_ppaps tps WHERE tps.FK_PPAP_Number LIKE 'PP00012%';
                
                SELECT DISTINCT
                        IMDS_ID_no
                    FROM customers
                    UNION 
                    SELECT DISTINCT
                        IMDS
                    FROM ppap;
                    
SELECT PPAP_Number
        FROM ppap p
        INNER JOIN customer_pn cpn ON p.FK_Customer_PN = cpn.Customer_PN
        INNER JOIN customers c ON cpn.FK_Customer_ID = c.Customer_ID
        LEFT JOIN customer_ppap_number cppn ON c.Customer_ID = cppn.FK_Customer_ID
        WHERE NAME = 'CEMM' AND Country = 'Mexico' 
		  ORDER BY PPAP_Number DESC LIMIT 1;
		  
		  
		  SELECT * FROM customers WHERE products LIKE '%Bluseal%';
		  
		  
SELECT * FROM ppap 
INNER JOIN customer_pn cpn ON ppap.FK_Customer_PN = cpn.Customer_PN
INNER JOIN products p ON cpn.FK_Eurotech_PN = p.Eurotech_PN
WHERE Product = 'Tube' AND ppap.PPAP_Request_Date IS NULL AND ppap.PPAP_Sent_Customer IS NULL AND ppap.PPAP_Signed_Date IS NULL;


SELECT 
                            if(PPAP_Sent_Customer IS NULL, datediff(NOW(), PPAP_Request_Date), datediff(PPAP_Sent_Customer, PPAP_Request_Date)) AS 'Days to Submit',
                            ppap.*,
                            cp.Customer_PN,
                            p.*,
                            c.`Name` AS 'Customer',
                            c.IMDS_ID_no,
                            v.`Name` AS 'Vendor',
                            v.Short_name,
                            cpn.*
                        FROM products p
                            LEFT JOIN customer_pn cp ON p.Eurotech_PN = cp.FK_Eurotech_PN
                            LEFT JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
                            INNER JOIN ppap ON cp.Customer_PN = ppap.FK_Customer_PN
                            LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
                            LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
                        WHERE Product = 'Tube'
                        ORDER BY PPAP_Number;
                        
                        SELECT 
                            if(PPAP_Sent_Customer IS NULL, datediff(NOW(), PPAP_Request_Date), datediff(PPAP_Sent_Customer, PPAP_Request_Date)) AS 'Days to Submit',
                            ppap.*,
                            cp.Customer_PN,
                            p.*,
                            c.`Name` AS 'Customer',
                            c.IMDS_ID_no,
                            v.`Name` AS 'Vendor',
                            v.Short_name,
                            cpn.*
                        FROM products p
                            LEFT JOIN customer_pn cp ON p.Eurotech_PN = cp.FK_Eurotech_PN
                            LEFT JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
                            INNER JOIN ppap ON cp.Customer_PN = ppap.FK_Customer_PN
                            LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
                            LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
                        ORDER BY Eurotech_PN;

SELECT PPAP_Number
        FROM ppap p
        INNER JOIN customer_pn cpn ON p.FK_Customer_PN = cpn.Customer_PN
        INNER JOIN customers c ON cpn.FK_Customer_ID = c.Customer_ID
        LEFT JOIN customer_ppap_number cppn ON p.PPAP_Number LIKE CONCAT('%', cppn.Customer_PPAP_Number, '%')
        WHERE NAME = 'SEWS (Sumitomo Electric Wiring Systems)' AND Country = 'Mexico' AND customer_pn = '40021861'
        LIMIT 1
        
SELECT PPAP_Number
        FROM ppap p
        INNER JOIN customer_pn cpn ON p.FK_Customer_PN = cpn.Customer_PN
        INNER JOIN customers c ON cpn.FK_Customer_ID = c.Customer_ID
        LEFT JOIN customer_ppap_number cppn ON p.PPAP_Number LIKE CONCAT('%', cppn.Customer_PPAP_Number, '%')
        WHERE NAME = 'SEWS (Sumitomo Electric Wiring Systems)' AND Country = 'Mexico'
        ORDER BY PPAP_Number DESC LIMIT 1
        
SELECT Customer_PPAP_Number
        FROM customer_ppap_number cppn
        INNER JOIN customers c ON c.Customer_ID = cppn.FK_Customer_ID
        WHERE NAME = 'SEWS (Sumitomo Electric Wiring Systems)' AND Country = 'Mexico'
        ORDER BY Customer_PPAP_Number LIMIT 1
        
SELECT 
                            if(PPAP_Sent_Customer IS NULL, datediff(NOW(), PPAP_Request_Date), datediff(PPAP_Sent_Customer, PPAP_Request_Date)) AS 'Days to Submit',
                            ppap.*,
                            cp.Customer_PN,
                            p.*,
                            c.`Name` AS 'Customer',
                            c.IMDS_ID_no,
                            v.`Name` AS 'Vendor',
                            v.Short_name,
                            cpn.*
                        FROM products p
                            LEFT JOIN customer_pn cp ON p.Eurotech_PN = cp.FK_Eurotech_PN
                            LEFT JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
                            INNER JOIN ppap ON cp.Customer_PN = ppap.FK_Customer_PN
                            LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
                            LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
                        ORDER BY Eurotech_PN;
                        
SELECT 
                            if(PPAP_Sent_Customer IS NULL, datediff(NOW(), PPAP_Request_Date), datediff(PPAP_Sent_Customer, PPAP_Request_Date)) AS 'Days to Submit',
                            ppap.*,
                            cp.Customer_PN,
                            p.*,
                            c.`Name` AS 'Customer',
                            c.IMDS_ID_no,
                            v.`Name` AS 'Vendor',
                            v.Short_name,
                            cpn.*
                        FROM products p
                            LEFT JOIN customer_pn cp ON p.Eurotech_PN = cp.FK_Eurotech_PN
                            LEFT JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
                            INNER JOIN ppap ON cp.Customer_PN = ppap.FK_Customer_PN
                            LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
                            LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
                        WHERE Product = 'Tube'
                        ORDER BY Eurotech_PN;
                        
                        
SELECT 
                            if(PPAP_Sent_Customer IS NULL, datediff(NOW(), PPAP_Request_Date), datediff(PPAP_Sent_Customer, PPAP_Request_Date)) AS 'Days to Submit',
                            ppap.*,
                            cp.Customer_PN,
                            p.*,
                            c.`Name` AS 'Customer',
                            c.IMDS_ID_no,
                            v.`Name` AS 'Vendor',
                            v.Short_name,
                            cpn.*
                        FROM products p
                            LEFT JOIN customer_pn cp ON p.Eurotech_PN = cp.FK_Eurotech_PN
                            LEFT JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
                            INNER JOIN ppap ON cp.Customer_PN = ppap.FK_Customer_PN
                            LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
                            LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
                        ORDER BY Eurotech_PN;
                        
SELECT if(PPAP_Sent_Customer IS NULL, datediff(NOW(), PPAP_Request_Date), datediff(PPAP_Sent_Customer, PPAP_Request_Date)) AS 'Days to Submit', ppap.*, cp.Customer_PN, p.*, c.`Name` AS 'Customer', c.IMDS_ID_no, v.`Name` AS 'Vendor', v.Short_name FROM products p LEFT JOIN customer_pn cp ON p.Eurotech_PN = cp.FK_Eurotech_PN LEFT JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID INNER JOIN ppap ON cp.Customer_PN = ppap.FK_Customer_PN LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID HAVING Customer = 'CEMM' AND ppap.Country = 'Mexico' AND (Product = 'BluSeal' OR Product = 'Cable' OR Product = 'Tape' OR Product = 'Tube') ORDER BY Eurotech_PN;

SELECT
	ppap.*,
	cp.Customer_PN,
   p.*,
   c.`Name` AS 'Customer'
FROM ppap 
INNER JOIN customer_pn cp ON ppap.FK_Customer_PN_ID = cp.Customer_PN_ID
INNER JOIN products p ON cp.FK_Eurotech_PN = p.Eurotech_PN
INNER JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
WHERE p.Product = "Tube"
ORDER BY Eurotech_PN;

SELECT
	ppap.*,
	cp.Customer_PN,
   p.*,
   c.`Name` AS 'Customer'
FROM ppap 
INNER JOIN customer_pn cp ON ppap.FK_Customer_PN_ID = cp.Customer_PN_ID
INNER JOIN products p ON cp.FK_Eurotech_PN = p.Eurotech_PN
INNER JOIN customers c ON cp.FK_Customer_ID = c.Customer_ID
LEFT JOIN vendors v ON ppap.FK_Vendor_ID = v.Vendor_ID
LEFT JOIN customer_ppap_number cpn ON ppap.PPAP_Number LIKE CONCAT('%', cpn.Customer_PPAP_Number, '%')
HAVING PPAP_Number = 'PP00024-0002' 
		AND `Customer` = 'Lear EU' 
		AND Customer_PN = 'E2624100'
		AND Eurotech_PN = 'P000042'
		AND (PPAP_Sent_Customer >= '2024-12-15' 
						OR PPAP_Signed_Date >= '2024-12-15' 
						OR PPAP_Request_Date >= '2025-10-15')
ORDER BY PPAP_Request_Date desc;