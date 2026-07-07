<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class DocumentPreviewService
{
    protected string $soffice;

    public function __construct()
    {
        // Đường dẫn LibreOffice trên Windows
        $this->soffice = '"C:\Program Files\LibreOffice\program\soffice.exe"';
    }

    /**
     * Chuyển file Office sang PDF
     */
    public function convertToPdf(string $relativePath): ?string
    {
        $input = storage_path('app/public/' . $relativePath);

        if (!file_exists($input)) {
            Log::error("Không tìm thấy file: {$input}");
            return null;
        }

        $outputDir = storage_path('app/public/previews');

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $command =
            $this->soffice .
            ' --headless' .
            ' --convert-to pdf' .
            ' --outdir "' . $outputDir . '"' .
            ' "' . $input . '"';

    exec($command . " 2>&1", $output, $returnCode);

    Log::info('LibreOffice', [
        'command' => $command,
        'output' => $output,
        'returnCode' => $returnCode,
    ]);

        if ($returnCode !== 0) {
            Log::error('LibreOffice convert failed', [
                'command' => $command,
                'output' => $output,
                'return_code' => $returnCode,
            ]);

            return null;
        }

        $pdfName = pathinfo($input, PATHINFO_FILENAME) . '.pdf';

        $pdfPath = $outputDir . DIRECTORY_SEPARATOR . $pdfName;

        if (!file_exists($pdfPath)) {
            Log::error("Không tạo được file PDF: {$pdfPath}");
            return null;
        }

        return 'previews/' . $pdfName;
    }
}