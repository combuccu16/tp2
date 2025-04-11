<?php
require_once '../studentController.php';

$studentController = new studentController();
$students = $studentController->getStudents($limit, $offset); // get all without limit/offset

$type = $_GET['type'] ?? 'csv';

if ($type === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=students.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Nom', 'Prénom', 'Date de naissance', 'Section']);

    foreach ($students as $student) {
        fputcsv($output, [
            $student['id'],
            $student['name'],
            $student['birthday'],
            $student['section']
        ]);
    }

    fclose($output);
    exit;
}

if ($type === 'pdf') {
    require_once '../../vendor/autoload.php'; // if using Composer + mPDF

    $mpdf = new \Mpdf\Mpdf();

    $html = '<h3>Liste des étudiants</h3>';
    $html .= '<table border="1" style="width: 100%; border-collapse: collapse;">';
    $html .= '<thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Section</th></tr></thead><tbody>';

    foreach ($students as $student) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($student['id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($student['name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($student['birthday']) . '</td>';
        $html .= '<td>' . htmlspecialchars($student['section']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    $mpdf->WriteHTML($html);
    $mpdf->Output('students.pdf', 'D'); // 'D' means download
    exit;
}
