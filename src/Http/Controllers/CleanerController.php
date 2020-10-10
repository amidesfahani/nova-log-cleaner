<?php

namespace Amidesfahani\NovaLogCleaner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Amidesfahani\NovaLogCleaner\CleanerHelpers;

class CleanerController extends Controller
{
    /**
     * A filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $disk;
    
    public function forget(Request $request): array
    {
        //forget
        $files = $this->getLogFiles();

        if ($files->count() >= 1) {
            $files->shift();
        }

        $deleted = $this->delete($files);

        // if (! $deleted) {
        //     $this->info('There was no log file to delete in the log folder');
        // } elseif ($deleted == 1) {
        //     $this->info('1 log file has been deleted');
        // } else {
        //     $this->info($deleted . ' log files have been deleted');
        // }
        return [
            'success' => (bool)$deleted,
            'size' => CleanerHelpers::getFileLogSize(),
        ];
    }

    /**
     * Get a collection of log files sorted by their last modification date.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getLogFiles(): Collection
    {
        $disk = new Filesystem;
        $this->disk = $disk;
        return collect(
            $this->disk->allFiles(storage_path('logs'))
        )->sortBy('mtime');
    }

    /**
     * Delete the given files.
     *
     * @param \Illuminate\Support\Collection $files
     * @return int
     */
    private function delete(Collection $files): int
    {
        return $files->each(function ($file) {
            $this->disk->delete($file);
        })->count();
    }

    public function get(Request $request): array
    {
        return [
            'success' => true,
            'size' => CleanerHelpers::getFileLogSize(),
        ];
    }
}
