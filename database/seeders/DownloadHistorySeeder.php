<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentVersion;
use App\Models\DownloadHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DownloadHistorySeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('roles.role_name', 'student')
            ->pluck('users.user_id')
            ->toArray();

        $versions = DocumentVersion::query()
            ->whereNotNull('document_id')
            ->get();

        if (empty($userIds) || $versions->isEmpty()) {
            return;
        }

        DownloadHistory::query()->delete();

        foreach ($versions as $version) {
            $randomDownloadCount = rand(3, 15);

            for ($i = 0; $i < $randomDownloadCount; $i++) {
                DownloadHistory::create([
                    'user_id' => $userIds[array_rand($userIds)],
                    'version_id' => $version->version_id,
                    'downloaded_at' => now()
                        ->subDays(rand(0, 180))
                        ->subHours(rand(0, 23))
                        ->subMinutes(rand(0, 59)),
                ]);
            }
        }

        Document::query()->update([
            'download_count' => 0,
        ]);

        $downloadCounts = DownloadHistory::query()
            ->join('document_versions', 'download_histories.version_id', '=', 'document_versions.version_id')
            ->select('document_versions.document_id', DB::raw('COUNT(*) as total'))
            ->groupBy('document_versions.document_id')
            ->get();

        foreach ($downloadCounts as $item) {
            Document::where('document_id', $item->document_id)
                ->update([
                    'download_count' => $item->total,
                ]);
        }
    }
}