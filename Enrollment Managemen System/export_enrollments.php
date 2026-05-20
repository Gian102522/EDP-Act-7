<?php

require 'vendor/autoload.php';
require_once "config/Database.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


$db = new Database();

$spreadsheet = new Spreadsheet();

/* =========================
   SHEET 1 - ENROLLMENT REPORT
========================= */

$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Enrollment Report');

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
$sheet->setCellValue('B8', 'Student ID');
$sheet->setCellValue('C8', 'Student Name');
$sheet->setCellValue('D8', 'Course ID');
$sheet->setCellValue('E8', 'Course Name');
$sheet->setCellValue('F8', 'Enrollment Date');

/* FETCH DATA */

$query = "
    SELECT * FROM enrollments
";

$result = $db->conn->query($query);

$row = 9;

while($data = $result->fetch_assoc()){

    $sheet->setCellValue('A'.$row, $data['enrollment_id']);
    $sheet->setCellValue('B'.$row, $data['student_id']);
    $sheet->setCellValue('C'.$row, $data['student_name']);
    $sheet->setCellValue('D'.$row, $data['course_id']);
    $sheet->setCellValue('E'.$row, $data['course_name']);
    $sheet->setCellValue('F'.$row, $data['enrollment_date']);

    $row++;
}

/* AUTO SIZE */

foreach(range('A','F') as $column){

    $sheet->getColumnDimension($column)
          ->setAutoSize(true);
}

/* SIGNATURE */

$sheet->setCellValue('A'.($row+3), '_____________________');
$sheet->setCellValue('A'.($row+4), 'Registrar');

/* =========================
   SHEET 2 - GRAPH DATA
========================= */

$chartSheet = $spreadsheet->createSheet();

$chartSheet->setTitle('Graph');

/* TITLE */

$chartSheet->setCellValue('A1', 'Enrollment Statistics');

/* TOTAL ENROLLMENTS */

$totalEnrollments = $row - 9;

$chartSheet->setCellValue('A3', 'Total Enrollments');
$chartSheet->setCellValue('B3', $totalEnrollments);

/* TOTAL COURSES */

$courseQuery = "
    SELECT COUNT(DISTINCT course_id) AS total_courses
    FROM enrollments
";

$courseResult = $db->conn->query($courseQuery);

$courseData = $courseResult->fetch_assoc();

$totalCourses = $courseData['total_courses'];

$chartSheet->setCellValue('A4', 'Total Courses');
$chartSheet->setCellValue('B4', $totalCourses);

/* COURSE BREAKDOWN */

$chartSheet->setCellValue('A6', 'Course Name');
$chartSheet->setCellValue('B6', 'Students Enrolled');

$breakdownQuery = "
    SELECT course_name, COUNT(*) AS total_students
    FROM enrollments
    GROUP BY course_name
";

$breakdownResult = $db->conn->query($breakdownQuery);

$graphRow = 7;

while($graphData = $breakdownResult->fetch_assoc()){

    $chartSheet->setCellValue(
        'A'.$graphRow,
        $graphData['course_name']
    );

    $chartSheet->setCellValue(
        'B'.$graphRow,
        $graphData['total_students']
    );

    $graphRow++;
}

/* AUTO SIZE */

foreach(range('A','B') as $column){

    $chartSheet->getColumnDimension($column)
               ->setAutoSize(true);
}
/* DOWNLOAD */

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment; filename="enrollment_report.xlsx"');

header('Cache-Control: max-age=0');

$writer->save('php://output');

exit;
?>