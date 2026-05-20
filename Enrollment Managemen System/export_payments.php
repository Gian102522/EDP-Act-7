<?php

require 'vendor/autoload.php';
require_once "config/Database.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$db = new Database();

$spreadsheet = new Spreadsheet();

/* =========================
   SHEET 1 - PAYMENT REPORT
========================= */

$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Payment Report');

/* INSERT LOGO */

$drawing = new Drawing();

$drawing->setName('Logo');

$drawing->setDescription('System Logo');

$drawing->setPath('logo.png'); // image path

$drawing->setHeight(100);

$drawing->setCoordinates('A1');

$drawing->setWorksheet($sheet);

/* HEADER */
$sheet->setCellValue('A5', 'Enrollment Management System');
$sheet->setCellValue('A6', 'Payment Transactions Report');

$sheet->setCellValue('A8', 'Payment ID');
$sheet->setCellValue('B8', 'Student ID');
$sheet->setCellValue('C8', 'Student Name');
$sheet->setCellValue('D8', 'Amount');
$sheet->setCellValue('E8', 'Payment Date');

/* FETCH DATA */

$query = "
    SELECT * FROM payments
";

$result = $db->conn->query($query);

$row = 9;

$total = 0;

while($data = $result->fetch_assoc()){

    $sheet->setCellValue('A'.$row, $data['payment_id']);
    $sheet->setCellValue('B'.$row, $data['student_id']);
    $sheet->setCellValue('C'.$row, $data['student_name']);
    $sheet->setCellValue('D'.$row, $data['amount']);
    $sheet->setCellValue('E'.$row, $data['payment_date']);

    $total += $data['amount'];

    $row++;
}

/* TOTAL */

$sheet->setCellValue('B'.$row, 'TOTAL');
$sheet->setCellValue('C'.$row, $total);

/* AUTO SIZE */

foreach(range('A','D') as $column){

    $sheet->getColumnDimension($column)
          ->setAutoSize(true);
}

/* SIGNATURE */

$sheet->setCellValue('A'.($row+3), '_____________________');
$sheet->setCellValue('A'.($row+4), 'Cashier');

/* =========================
   SHEET 2 - GRAPH DATA
========================= */

$chartSheet = $spreadsheet->createSheet();

$chartSheet->setTitle('Graph');

/* TITLE */

$chartSheet->setCellValue('A1', 'Payment Statistics');

/* TOTAL PAID STUDENTS */

$paidStudentsQuery = "
    SELECT COUNT(DISTINCT student_name) AS total_paid_students
    FROM payments
";

$paidStudentsResult = $db->conn->query($paidStudentsQuery);

$paidStudentsData = $paidStudentsResult->fetch_assoc();

$totalPaidStudents = $paidStudentsData['total_paid_students'];

$chartSheet->setCellValue('A3', 'Total Paid Students');
$chartSheet->setCellValue('B3', $totalPaidStudents);

/* GRAND TOTAL COLLECTION */

$grandTotalQuery = "
    SELECT SUM(amount) AS grand_total
    FROM payments
";

$grandTotalResult = $db->conn->query($grandTotalQuery);

$grandTotalData = $grandTotalResult->fetch_assoc();

$grandTotal = $grandTotalData['grand_total'];

/* AVERAGE PAYMENT */

$averagePayment = 0;

if($totalPaidStudents > 0){

    $averagePayment = $grandTotal / $totalPaidStudents;
}

/* DISPLAY AVERAGE PAYMENT */

$chartSheet->setCellValue('A4', 'Average Payment');

$chartSheet->setCellValue(
    'B4',
    '₱' . number_format($averagePayment, 2)
);

/* DISPLAY GRAND TOTAL */

$chartSheet->setCellValue('A5', 'Grand Total Collection');

$chartSheet->setCellValue(
    'B5',
    '₱' . number_format($grandTotal, 2)
);

/* TABLE STYLE */

$chartSheet->getStyle('A1:B5')
           ->getFont()
           ->setBold(true);

/* AUTO SIZE */

foreach(range('A','B') as $column){

    $chartSheet->getColumnDimension($column)
               ->setAutoSize(true);
}

/* DOWNLOAD */

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment; filename="payment_report.xlsx"');

header('Cache-Control: max-age=0');

$writer->save('php://output');

exit;
?>