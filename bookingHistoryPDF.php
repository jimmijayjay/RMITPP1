<?php

  require_once 'includes/init.php';

  $pdf = new PDF();
  $user = new User($_SESSION['car_buddy_userid']);

  // Column headings
  $header = array('Date', 'Vehicle', 'Vehicle Type', 'Booking Duration', 'Booking Fee');

  // Data loading
  //$data = $pdf->LoadData('countries.txt');
  $data = $user->getBookingsForPDF($user->getUserID());

  $pdf->SetFont('Arial','',14);
  $pdf->AddPage();
  $pdf->FancyTable($header,$data);
  $pdf->Output();

?>
