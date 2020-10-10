<?php

namespace Amidesfahani\NovaLogCleaner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Amidesfahani\NovaLogCleaner\CleanerHelpers;

class CleanerController extends Controller
{
    public function forgot(Request $request): array
    {}

    public function fetch(Request $request): array
    {
        return [
            'success' => (bool)$result,
            'key' => htmlentities($key),
            'value' => $result,
            'size' => CleanerHelpers::getFileLogSize(),
        ];
    }
}
