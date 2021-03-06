<?php

namespace Amidesfahani\NovaLogCleaner;

class CleanerHelpers {
    /**
     * Returns the size of a folder in bytes.
     *
     * @param string $folder
     * @return int
     */
    public static function getFolderSizeInBytes($folder)
    {
        $size = 0;
        foreach (glob(rtrim($folder, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : self::getFolderSizeInBytes($each);
        }
        return $size;
    }

    /**
     * Converts a file size from bytes to a human readable string.
     *
     * @param int $size
     * @return string
     */
    public static function sizeInBytesToReadable($size)
    {
        if ($size < 1024) {
            $size = $size." ".__('Bytes');
        } else if ($size < 1048576 && $size > 1023) {
            $size = round($size / 1024, 1) . " " . __('KB');
        } else if ($size < 1073741824 && $size > 1048575) {
            $size = round($size / 1048576, 1) . " " . __('MB');
        } else {
            $size = round($size / 1073741824, 1) . " " . __('GB');
        }

        return $size;
    }

    /**
     * Returns the current size of the local file cache if it is enabled.
     *
     * @return string
     */
    public static function getFileLogSize()
    {
        $path = storage_path('logs');
        $sizeInBytes = self::getFolderSizeInBytes($path);
        return self::sizeInBytesToReadable($sizeInBytes);
    }
}
