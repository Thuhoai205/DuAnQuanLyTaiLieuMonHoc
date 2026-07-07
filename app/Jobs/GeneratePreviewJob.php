<?php

namespace App\Jobs;

use App\Models\DocumentVersion;
use App\Services\DocumentPreviewService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class GeneratePreviewJob implements ShouldQueue
{
    
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $versionId;

    public function __construct($versionId)
    {
        $this->versionId = $versionId;
    }

    public function handle(DocumentPreviewService $previewService)
    {
        $version = DocumentVersion::find($this->versionId);

        if (!$version) {
            return;
        }

        // Đã có preview thì không convert nữa
        if ($version->preview_file) {
            return;
        }

        try {

            $preview = $previewService->convertToPdf(
                $version->file_path
            );

            $version->update([
                'preview_file' => $preview
            ]);

        } catch (\Throwable $e) {

            Log::error('Generate Preview Error', [
                'version_id' => $this->versionId,
                'message' => $e->getMessage(),
            ]);

        }
    }
}