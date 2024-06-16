<?php
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF
{
    // Load table data from file
    public function LoadData()
    {
        // Read file lines
        include 'dataconnection.php';
        $select = "SELECT 
                        o.order_id, 
                        o.user_id, 
                        o.payment_method, 
                        (SELECT SUM(quantity) FROM order_items WHERE order_id = o.order_id) AS total_product_quantity, 
                        (SELECT SUM(quantity) FROM order_tickets WHERE order_id = o.order_id) AS total_ticket_quantity, 
                        o.total_price, 
                        o.created_at 
                   FROM order_detail o 
                   WHERE o.payment_status = 'completed'";
        $query = mysqli_query($connect, $select);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $row['total_products'] = $row['total_product_quantity'] + $row['total_ticket_quantity'];
            $data[] = $row;
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        $w = array(20, 20, 36, 31, 23, 42);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = 0;
        $sumTotalPrice = 0; // Initialize sum variable

        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row["order_id"], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row["user_id"], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row["payment_method"], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row["total_products"], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, 'RM' . number_format($row["total_price"], 2), 'LR', 0, 'L', $fill); // Added currency format
            $this->Cell($w[5], 6, $row["created_at"], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;

            // Calculate sum of total price for each row
            $sumTotalPrice += $row["total_price"];
        }

        // Set the left margin to a smaller value
        $this->SetLeftMargin(0); // Adjust as needed

        // Print "Total Sales" after processing all rows
        $this->SetFont('', 'B', 10);
        $this->Cell(20, 7, 'Total Sales:', 0, 0, 'L');
        $this->Cell(0.1, 7, 'RM' . number_format($sumTotalPrice, 2), 0, 0, 'L');
        $this->Cell(array_sum($w) - 20.1, 0, '', 'T'); // Adjust subtracted value as needed
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('F1 SALES REPORT 2024');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('Order ID', 'User ID', 'Payment Method', 'Total Products', 'Total Price', 'Order Date');

// data loading
$data = $pdf->LoadData();

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('admin_sales report.pdf', 'I');
