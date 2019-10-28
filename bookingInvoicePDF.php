<?php

  require_once 'includes/init.php';

  $pdf = new PDF();
  $booking = new Booking($_GET['bookingid']);

  $bookingStartDate = date_create($booking->getBookingStartTime());
  $bookingEndDate = date_create($booking->getBookingEndTime());
  $bookingTotal = $booking->getBookingTotal();

  $bookingStartDateTime = date_format($bookingStartDate, "d M, Y g:i A");
  $bookingEndDateTime = date_format($bookingEndDate, "d M, Y g:i A");

  $pdf->AddPage();

  /************** HEADER **************/
  $pdf->SetFont('Arial', '', 16);
  $pdf->Cell(190, 20, 'INVOICE', 0, 1, 'C');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(60, 6, 'CAR BUDDY', 0, 1);
  $pdf->Cell(60, 6, '124 La Trobe Street,', 0, 1);
  $pdf->Cell(60, 6, 'Melbourne VIC 3000', 0, 1);
  $pdf->Cell(60, 6, '+61 3 9925 2000', 0, 1);

  $pdf->Cell(190, 40, 'Invoice #00001', 0, 1, 'C');
  $pdf->Cell(60, 10, '', 0, 1);

  /************** BODY **************/
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->setFillColor(230,230,230);
  $pdf->Cell(150, 10, '   Description', 1, 0, 'L', true);
  $pdf->Cell(40, 10, '   Amount', 1, 1, 'L', true);

  $pdf->SetFont('Arial', '', 12);
  $pdf->MultiCell(190, 20, "Car share from $bookingStartDateTime to $bookingEndDateTime                                         $$bookingTotal\n\n\n", 1, 'L');

  $pdf->Cell(150, 10, 'Total:     ', 1, 0, 'R');
  $pdf->Cell(40, 10, '$' . $bookingTotal . '     ', 1, 1, 'R');





  $pdf->Output();

?>
