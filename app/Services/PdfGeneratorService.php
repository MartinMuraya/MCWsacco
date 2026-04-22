<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfGeneratorService
{
    /**
     * Generate a PDF from a view and optionally save or return it
     *
     * @param string $view
     * @param array $data
     * @param string|null $savePath (e.g. 'loans/applications/MWS-2026-0001.pdf')
     * @return \Barryvdh\DomPDF\PDF|string
     */
    public function generate(string $view, array $data, ?string $savePath = null)
    {
        $pdf = Pdf::loadView($view, $data);

        if ($savePath) {
            Storage::disk('public')->put($savePath, $pdf->output());
            return $savePath;
        }

        return $pdf;
    }
}
