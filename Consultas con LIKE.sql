-- /// BLUSEAL ///
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
	LEFT JOIN bluseal_ppap bp ON bcp.BS_Customer_PN = bp.FK_BS_Customer_PN
WHERE b.Model LIKE '%'
	AND b.`Description` LIKE '%'
	-- AND bc.`Name` LIKE '%'
	-- AND bcp.BS_Customer_PN LIKE '%'
	AND b.Supplier LIKE '%'
	AND b.Supplier_PN LIKE '%'
;	
	
	
-- /// CABLES ///
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
	LEFT JOIN cables_customer c ON ccp.FK_ID_CAB_Customer = c.ID_CAB_Customer
WHERE Eurotech_PN_CAB LIKE '%'
	-- AND Coroflex_PN LIKE '%'
	-- AND CAB_Customer_PN LIKE '%'
	AND `Description` LIKE '%'
	-- AND `Name` LIKE '%'
;
	
	
-- /// CINTAS MISSING ///
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
	INNER JOIN tapes t ON tcp.FK_Eurotech_PN_TAP = t.Eurotech_PN_TAP
WHERE `Name` LIKE '%'
	AND FK_TAP_Customer_PN LIKE '%'
	AND `Description` LIKE '%'
	-- AND CTC LIKE '%'
	-- AND Form_Sent_Cust BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND Reminder BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND `Received-RQ_Sent_CTC` BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND Closing_Date BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
;

	
-- /// CINTAS ///	
SELECT 
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
	tp.Comments
FROM tapes_ppap tp
	INNER JOIN tapes_customer_pn tcp ON tp.FK_TAP_Customer_PN  = tcp.TAP_Customer_PN
	INNER JOIN tapes_customers tc ON tcp.FK_ID_TAP_Customer = tc.ID_TAP_Customer
	INNER JOIN tapes t ON tcp.FK_Eurotech_PN_TAP = t.Eurotech_PN_TAP
	LEFT JOIN tapes_renewal tr ON tp.ID_TAP_PPAP = tr.FK_ID_TAP_PPAP
WHERE tc.`Name` LIKE '%'
	-- AND tp.PPAP_level LIKE '%'
	-- AND t.SAP_Number LIKE '%'
	AND tp.FK_TAP_Customer_PN LIKE '%'
	AND t.Tape LIKE '%'
	AND t.Width LIKE '%'
	AND t.`Length` LIKE '%'
	AND t.Color LIKE '%'
	-- AND tp.IMDS_ID_No LIKE '%'
	-- AND tp.`Returned_CTC-Sent_Cust` BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tp.`Cust_Signed-Sent_CTC` BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tr.Renewal_Date BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tr.Send_Request_CTC BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tr.Sent_Customer BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tr.Returned_Cust_Signed BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tp.PPAP_from_shipments LIKE '%'
;


-- /// TUBOS ///
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
	INNER JOIN tubes t ON tcp.FK_Eurotech_PN_TUB = t.Eurotech_PN_TUB
WHERE tp.PPAP_Number LIKE '%'
	-- AND tps.PPAP_Req_by_Cus_Date BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tps.Current_Status LIKE '%'
	-- AND tp.Vendor LIKE '%'
	AND tc.`Name` LIKE '%'
	-- AND tcc.Country LIKE '%'
	-- AND tcp.TUB_Customer_PN LIKE '%'
	-- AND t.ET_Model LIKE '%'
	-- AND t.ET_Dwg LIKE '%'
	-- AND t.Eurotech_PN_TUB LIKE '%'
	-- AND tps.`Level` LIKE '%'
	-- AND tps.Reason_submission LIKE '%'
	-- AND tps.Sent_Customer BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tps.PSW_Returned BETWEEN 'YYYY-MM-DD' AND 'YYYY-MM-DD'
	-- AND tps.Origin_from_report LIKE '%'
ORDER BY `Days to Submit`
;