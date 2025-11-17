<?php
require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf
{
    public function generate($html, $filename = '', $stream = true, $paper = 'A4', $orientation = 'portrait')
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
