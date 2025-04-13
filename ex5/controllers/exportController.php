<?php

require_once __DIR__ . '/vendor/autoload.php';
class Export {
    private $list ;
    private $content;
    public function __construct($content) {
        $this->content = $content;
        // Constructeur vide
        if($this->content == "stud"){
            $sc = new studentController();
            $this->list = $sc->getAllStudents();
        } else {
            $ss = new sectionController();
            $this->list = $ss->getAllSections();
        }
    }
    public function export($type) {
        switch ($type) {
            case 'csv':
                $this->toCSV();
                break;
            case 'excel':
                $this->toExcel();
                break;
            case 'pdf':
                $this->toPDF();
                break;
            default:
                echo "Type d'export inconnu.";
        }
    }

    public function toCSV() {


        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="list.csv"');

        $output = fopen('php://output', 'w');
        if($this->content == "stud"){ // Updated to use $this->content
            fputcsv($output, ['ID', 'Nom', 'Date de Naissance', 'Section']);
            foreach ($this->list as $e) {
                fputcsv($output, [$e['id'], $e['name'], $e['birthday'], $e['section']]);
            }
        } else {
            fputcsv($output, ['ID', 'Designation', 'Description']);
            foreach ($this->list as $e) {
                fputcsv($output, [$e['id'], $e['designation'], $e['description']]);
            }
        }

        fclose($output);
        exit;
    }

    public function toExcel() {

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"list.xls\"");
        if($this->content == "stud"){ // Updated to use $this->content
            echo "ID\tNom\tDate de Naissance\tSection\n";
            foreach ($this->list as $e) {
                echo "{$e['id']}\t{$e['name']}\t{$e['birthday']}\t{$e['section']}\n";
            }
        } else {
            echo "ID\tDesignation\tDescription\n";
            foreach ($this->list as $e) {
                echo "{$e['id']}\t{$e['designation']}\t{$e['description']}\n";
            }
        }

        exit;
    }

    public function toPDF() {
        require_once __DIR__ . '/vendor/autoload.php'; // Use Composer's autoloader
        $pdf = new \Fpdf\Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
        if($this->content == "stud"){ // Updated to use $this->content
            
            $pdf->Cell(20,10,'ID');
            $pdf->Cell(40,10,'Nom');
            $pdf->Cell(40,10,'Naissance');
            $pdf->Cell(50,10,'Section');
            $pdf->Ln();
        } else {
            $pdf->Cell(20,10,'ID');
            $pdf->Cell(40,10,'Designation');
            $pdf->Cell(40,10,'Description');
            $pdf->Ln();
        }

        $pdf->SetFont('Arial','',12);
        if($this->content == "stud"){ // Updated to use $this->content

            foreach ($this->list as $e) {
                $pdf->Cell(20,10,$e['id']);
                $pdf->Cell(40,10,$e['name']);
                $pdf->Cell(40,10,$e['birthday']);
                $pdf->Cell(50,10,$e['section']);
                $pdf->Ln();
            }
        } else {
            foreach ($this->list as $e) {
                $pdf->Cell(20,10,$e['id']);
                $pdf->Cell(40,10,$e['designation']);
                $pdf->Cell(40,10,$e['description']);
                $pdf->Ln();
            }
        }

        $pdf->Output('D', 'list.pdf');
        exit;
    }
}
