<?php

class PDF extends FPDF
{
  // Load data
  function LoadData($file)
  {
    // Read file lines
    $lines = file($file);
    $data = array();

    foreach($lines as $line)
      $data[] = explode(';',trim($line));
    return $data;
  }

  // Simple table
  function BasicTable($header, $data)
  {
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);

    $this->Ln();

    // Data
    foreach($data as $row)
    {
      foreach($row as $col)
        $this->Cell(40,6,$col,1);
      $this->Ln();
    }
  }

  // Better table
  function ImprovedTable($header, $data)
  {
    // Column widths
    $w = array(40, 35, 40, 45);

    // Header
    for($i=0;$i<count($header);$i++)
      $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();

    // Data
    foreach($data as $row)
    {
      $this->Cell($w[0],6,$row[0],'LR');
      $this->Cell($w[1],6,$row[1],'LR');
      $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
      $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
      $this->Ln();
    }

    // Closing line
    $this->Cell(array_sum($w),0,'','T');
  }

  // Colored table
  function FancyTable($header, $data)
  {
    // Colors, line width and bold font
    $this->SetFillColor(211,211,211);
    $this->SetTextColor(0);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial','B', '10');

    // Header
    $w = array(22, 40, 30, 75, 25);

    for($i=0;$i<count($header);$i++)
      $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();

    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('Arial', '', '10');

    // Data
    $fill = false;
    foreach($data as $row)
    {
      $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
      $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
      $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
      $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
      $this->Cell($w[4],6,$row[4],'LR',0,'R',$fill);
      $this->Ln();
      $fill = !$fill;
    }

    // Closing line
    $this->Cell(array_sum($w),0,'','T');
  }
}
