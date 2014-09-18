<?php 
if(isset($_POST["submit"]))
{
$location = $_POST["location"];
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$landlord = $_POST["landlord"];
$tenant = $_POST["tenant"];
$pr_no = $_POST["pr_no"];
$pr_str = $_POST["pr_str"];
$pr_city = $_POST["pr_city"];
$term_beg = $_POST["term_beg"];
$term_end = $_POST["term_end"];
$pay_amt = $_POST["pay_amt"];
$pay_date = $_POST["pay_date"];
$utils = $_POST["utils"];
$depo = $_POST["depo"];
$pay = '';
$price = str_replace(",",".",$price);
$vat = str_replace(",",".",$vat);
$p = explode(" ",$price);
$v = explode(" ",$vat);
$re = $p[0] + $v[0];
function r($r)
{
$r = str_replace("$","",$r);
$r = str_replace(" ","",$r);
$r = $r." $";
return $r;
}
$price = r($price);
$vat = r($vat);
require('fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
if(!empty($_FILES["file"]))
  {
$uploaddir = "logo/";
$nm = $_FILES["file"]["name"];
$random = rand(1,99);
move_uploaded_file($_FILES["file"]["tmp_name"], $uploaddir.$random.$nm);
$this->Image($uploaddir.$random.$nm,10,10,20);
unlink($uploaddir.$random.$nm);
}
$this->SetFont('Arial','B',12);
$this->Ln(1);
}
function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function ChapterTitle($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(200,220,255);
$this->Cell(0,6,"$num $label",0,1,'L',true);
$this->Ln(0);
}
function ChapterTitle2($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(249,249,249);
$this->Cell(0,6,"$num $label",0,1,'L',true);
$this->Ln(0);
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(32);
$pdf->Cell(0,5,$landlord,0,1,'R');
$pdf->Cell(0,5,$tenant,0,1,'R');
$pdf->Cell(0,5,$pay_amt,0,1,'R');
$pdf->Cell(0,5,'Tel: '.$pay_date,0,1,'R');
$pdf->Cell(0,30,'',0,1,'R');
$pdf->SetFillColor(200,220,255);
$pdf->ChapterTitle('Agreement Duration',$term_beg," - ", $term_end);
$pdf->ChapterTitle('Deposit : ',$depo);
$pdf->Cell(0,20,'',0,1,'R');
$pdf->SetFillColor(224,235,255);
$pdf->SetDrawColor(192,192,192);
$pdf->Cell(170,7,'Details of Property',1,0,'L');
$pdf->Cell(20,7,'Value',1,1,'C');
$pdf->Cell(170,7,$pr_no,1,0,'L',0);
$pdf->Cell(20,7,$pr_str,1,1,'C',0);
$pdf->Cell(0,0,'',0,1,'R');
$pdf->Cell(170,7,'Property City',1,0,'L',0);
$pdf->Cell(20,7,$pr_city,1,1,'C',0);
$pdf->Cell(170,7,'Location',1,0,'R',0);
$pdf->Cell(20,7,$location,1,0,'C',0);
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(0,5,$pay,0,1,'L');
$pdf->Cell(0,5,$bank,0,1,'L');
$pdf->Cell(0,5,$iban,0,1,'L');
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(0,5,'Utilities offered:',0,1,'L');
$pdf->Cell(0,5,$utils,0,1,'L');
$pdf->Cell(190,40,$com,0,0,'C');
$filename="invoice.pdf";
$pdf->Output($filename,'F');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Make Your Agreement</title>
<style>
body{background-image:url(img/bg.jpg);
}
a{
color:#999999;
text-decoration:none;
}
a:hover{
color:#999999;
text-decoration:underline;
}
#content{
width:800px;
height:600px;
background-color:#FEFEFE;
border: 10px solid rgb(255, 255, 255);
border: 10px solid rgba(255, 255, 255, .5);
-webkit-background-clip: padding-box;
background-clip: padding-box;
border-radius: 10px;
opacity:0.90;
filter:alpha(opacity=90);
margin:auto;
}
#footer{
width:800px;
height:30px;
padding-top:15px;
color:#666666;
margin:auto;
}
#title{
width:770px;
margin:15px;
color:#999999;
font-size:18px;
font-family:Verdana, Arial, Helvetica, sans-serif;
}
#body{
width:770px;
height:360px;
margin:15px;
color:#999999;
font-size:16px;
font-family:Verdana, Arial, Helvetica, sans-serif;
}
#body_l{
width:385px;
height:360px;
float:left;
}
#body_r{
width:385px;
height:360px;
float:right;
}
#name{
width:width:385px;
height:40px;
margin-top:15px;
}
input{
margin-top:10px;
width:345px;
height:32px;
-moz-border-radius: 5px;
border-radius: 5px;
border:1px solid #ccc;
background-image:url(img/paper_fibers.png);
color:#999;
margin-left:15px;
padding:5px;
}
#up{
width:770px;
height:40px;
margin:auto;
margin-top:10px;
}
</style>
</head>

<body>
<div id="content">
<div id="title" align="center">Create your agreement</div>
<div id="body">
<form action="" method="post" enctype="multipart/form-data">
<div id="body_l">
<div id="name"><input name="location" placeholder="Insert location" type="text" /></div>
<div id="name"><input name="month" placeholder="Insert month" type="text" /></div>
<div id="name"><input name="year" placeholder="Insert year" type="text" /></div>
<div id="name"><input name="landlord" placeholder="Landlord" type="text" /></div>
<div id="name"><input name="tenant" placeholder="Tenant" type="text" /></div>
<div id="name"><input name="pr_no" placeholder="Property Number" type="text" /></div>
<div id="name"><input name="pr_str" placeholder="Property Street" type="text" /></div>
<div id="name"><input name="pr_city" placeholder="Property City" type="text" /></div>
</div>
<div id="body_r">
<div id="name"><input name="term_beg" placeholder="Term Begins on" type="text" /></div>
<div id="name"><input name="term_end" placeholder="Term ends" type="text" /></div>
<div id="name"><input name="pay_amt" placeholder="Paying Amount" type="text" /></div>
<div id="name"><input name="pay_date" placeholder="Date of pay" type="text" /></div>
<div id="name"><input name="utils" placeholder="Utilities offering by Landlord" type="text" /></div>
<div id="name"><input name="Depo" placeholder="Deposited acknowledged" type="text" /></div>
</div>
<div id="up" align="center"><input name="submit" style="margin-top:60px;" value="Create your Agreement" type="submit" /><br /><br />

<?php 
if(isset($_POST["submit"]))
{
echo'<a href="invoice.pdf">Download your Agreement</a>';
}
?>
</div>
</form>
</div>
</div>
<div id="footer" align="center">Created by <a href="http://alraislabs.com/" target="_blank">Alrais Labs</a></div>
</body>
</html>
