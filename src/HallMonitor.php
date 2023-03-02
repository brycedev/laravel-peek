<?php

namespace Brycedev\Peek;

use Brycedev\Peek\Models\RequestRecord;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HallMonitor
{
    public static $hiddenHeaders = [
        'authorization',
        'cookie',
        'php-auth-pw',
    ];

    public static $hiddenPayloads = [
        'password',
        'password_confirmation',
    ];

    public static function start($app)
    {
        $app['events']->listen(RequestHandled::class, [self::class, 'handleRequestHandled']);
    }

    public function handleRequestHandled($event)
    {
        $begin = $event->request->server('REQUEST_TIME_FLOAT');

        $request = $event->request;
        $response = $event->response;

        $duration = floor((microtime(true) - $begin) * 1000);

        if (self::shouldIgnore($request)) {
            return;
        }

        try {
            $record = new RequestRecord([
                'action' => optional($event->request->route())->getActionName(),
                'duration' => $duration,
                'memory' => round(memory_get_peak_usage(true) / 1024 / 1024, 1),
                'method' => $request->method(),
                'path' => $request->path(),
                'response_status' => $response->getStatusCode(),
                'url' => $request->fullUrl(),
                'payload' => json_encode(self::sanitize($this->getInput($request), self::$hiddenPayloads)),
                'headers' => json_encode(self::sanitize($request->headers->all(), self::$hiddenHeaders))
            ]);

            $record->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    // from laravel/telescope
    // https://github.com/laravel/telescope/blob/a3a218fa692350e1f5b3457b7af7ed061e91be54/src/Watchers/RequestWatcher.php#LL158

    private function getInput(Request $request)
    {
        $files = $request->files->all();

        array_walk_recursive($files, function (&$file) {
            $file = [
                'name' => $file->getClientOriginalName(),
                'size' => $file->isFile() ? ($file->getSize() / 1000).'KB' : '0',
            ];
        });

        return array_replace_recursive($request->input(), $files);
    }

    private function shouldIgnore($request)
    {
        $ignore_paths = config('laravel-peek.ignore_paths');

        return $request->is($ignore_paths);
    }

    private function sanitize($array, $hidden_values)
    {
        foreach($hidden_values as $hidden_value) {
            if (isset($array[$hidden_value])) {
                $array[$hidden_value] = '****HIDDEN****';
            }
        }
        return $array;
    }
}
