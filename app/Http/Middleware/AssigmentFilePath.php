<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssigmentFilePath
{
    public function handle(Request $request, Closure $next)
    {
        $path_array = config('api.uploadfile.supporter_setting_type');
        $file_path_id = $request->route()->parameter('file_path_id');
        $request->merge(['upload_path' => $path_array[$file_path_id]]);
        return $next($request);
    }
}
