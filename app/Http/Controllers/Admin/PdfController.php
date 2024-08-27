<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    public function export()
    {
        $data = coupon::all(); // Replace with your model and data

        // Instantiate Dompdf with options
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        // Generate PDF content
        $pdfView = view('pdf.export', compact('data'));
        $dompdf->loadHtml($pdfView->render());

        // Render PDF
        $dompdf->render();

        // Generate file name
        $fileName = 'table_data.pdf';

        // Generate file path
        $filePath = public_path($fileName);

        // Output PDF to file
        $dompdf->stream($fileName, ['Attachment' => false]);
    }
}
