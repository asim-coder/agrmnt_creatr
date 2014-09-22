<?php

$landlord = $_POST["landlord"];
$tenant = $_POST["tenant"];
$location = $_POST["location"];
$month = $_POST["month"];
$year = $_POST["year"];
$pr_no = $_POST["pr_no"];
$pr_str = $_POST["pr_str"];
$pr_city = $_POST["pr_city"];
$term_beg = $_POST["term_beg"];
$term_ends = $_POST["term_ends"];
$term_amt = $_POST["term_amt"];
$term_due = $_POST["term_due"];
$landlord = "Hai";


require('fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
    global $title;

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,230);
    $this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,9,$title,1,1,'C',true);
    // Line break
    $this->Ln(10);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function ChapterTitle($num, $label)
{
    // Arial 12
    $this->SetFont('Arial','',12);
    // Background color
    $this->SetFillColor(200,220,255);
    // Title
    $this->Cell(0,6,"SAMPLE LEASE OR RENTAL AGREEMENT",0,1,'L',true);
    // Line break
    $this->Ln(4);
}

function ChapterBody($file)
{
    // Read text file
    $txt = file_get_contents($file);
    // Times 12
    $this->SetFont('Times','',12);
    // Output justified text
    $this->MultiCell(0,5,$txt);
    // Line break
    $this->Ln();
    // Mention in italics
    $this->SetFont('','I');
    $this->Cell(0,5,'(end of agreement) ',0,1);
}

function PrintChapter($num, $title, $file)
{
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    $this->ChapterBody($file);
}
}

$pdf = new PDF();
$title = 'AGREEMENT';
$pdf->SetTitle($title);
$pdf->SetAuthor('Alrais Labs');
$pdf->PrintChapter(1,$title,'text.txt');
$pdf->Cell(0,5,$landlord,0,1);

$filename="agreement.pdf";
$pdf->Output($filename, 'F');
echo'<a href="agreement.pdf">Download your agreement</a>';
?>
