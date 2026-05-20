<?php

require 'vendor/autoload.php';
require_once "config/Database.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$db = new Database();

$spreadsheet = new Spreadsheet();

/* SHEET 1 */
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Student Report');

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
$sheet->setCellValue('A6', 'Student Report');

$sheet->setCellValue('A8', 'ID');
$sheet->setCellValue('B8', 'Name');
$sheet->setCellValue('C8', 'Email');
$sheet->setCellValue('D8', 'Status');


/* DATA */
$result = $db->conn->query("SELECT * FROM students");

$row = 9;

while($data = $result->fetch_assoc()){

    $sheet->setCellValue('A'.$row, $data['student_id']);
    $sheet->setCellValue('B'.$row, $data['student_name']);
    $sheet->setCellValue('C'.$row, $data['email']);
    $sheet->setCellValue('D'.$row, $data['status']);
    $row++;
}

/* SIGNATURE */
$sheet->setCellValue('A'.($row+3), '_____________________');
$sheet->setCellValue('A'.($row+4), 'System Administrator');

/* =========================
   SHEET 2 - GRAPH DATA
========================= */

$chartSheet = $spreadsheet->createSheet();

$chartSheet->setTitle('Graph');

/* TITLE */

$chartSheet->setCellValue('A1', 'Student Enrollment Statistics');

/* TOTAL STUDENTS */

$totalStudentsQuery = "
    SELECT COUNT(*) AS total_students
    FROM students
";

$totalStudentsResult = $db->conn->query($totalStudentsQuery);

$totalStudentsData = $totalStudentsResult->fetch_assoc();

$totalStudents = $totalStudentsData['total_students'];

$chartSheet->setCellValue('A3', 'Total Students');
$chartSheet->setCellValue('B3', $totalStudents);

/* ENROLLED STUDENTS */

$enrolledQuery = "
    SELECT COUNT(*) AS enrolled_students
    FROM students
    WHERE status='Enrolled'
";

$enrolledResult = $db->conn->query($enrolledQuery);

$enrolledData = $enrolledResult->fetch_assoc();

$enrolledStudents = $enrolledData['enrolled_students'];

$chartSheet->setCellValue('A4', 'Enrolled');
$chartSheet->setCellValue('B4', $enrolledStudents);

/* NOT YET ENROLLED */

$notEnrolled = $totalStudents - $enrolledStudents;

$chartSheet->setCellValue('A5', 'Not Yet Enrolled');
$chartSheet->setCellValue('B5', $notEnrolled);

/* PAID STUDENTS */

$paidQuery = "
    SELECT COUNT(*) AS paid_students
    FROM students
    WHERE payment_status='Paid'
";

$paidResult = $db->conn->query($paidQuery);

$paidData = $paidResult->fetch_assoc();

$paidStudents = $paidData['paid_students'];

$chartSheet->setCellValue('A6', 'Paid');
$chartSheet->setCellValue('B6', $paidStudents);

/* NOT YET PAID */

$notPaid = $totalStudents - $paidStudents;

$chartSheet->setCellValue('A7', 'Not Yet Paid');
$chartSheet->setCellValue('B7', $notPaid);

/* HEADERS BOLD */

$chartSheet->getStyle('A1:B7')
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

header('Content-Disposition: attachment;filename="students_report.xlsx"');

$writer->save('php://output');
exit;
?>