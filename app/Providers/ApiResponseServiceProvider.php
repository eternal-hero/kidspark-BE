<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\CustomizeJsonResource;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // APIレスポンスの共通化
        // success
        Response::macro('ok', function ($data = []) {
            $status = 200;
            $message = 'success';
            $response_array = [
                'status' => [
                    'code' => $status,
                    'message' => $message
                ],
            ];
            if ($data) $response_array['data'] = $data;
            return response()->json($response_array, $status);
        });
        // success
        Response::macro('okWithResource', function ($data = []) {
            if ($data instanceof \Illuminate\Database\Eloquent\Model) {
                return new CustomizeJsonResource($data);
            }
            return CustomizeJsonResource::collection($data)->additional([
                'status' => [
                    'code' => 200,
                    'message' => 'success'
                ],
            ]);
        });
        // created
        Response::macro('created', function () {
            $status = 201;
            $message = 'created';
            return response()->json([
                'status' => [
                    'code' => $status,
                    'message' => $message
                ],
            ], $status);
        });
        // invalid request parameter
        Response::macro('invalidRequestParameter', function ($invParam = '') {
            $status = 400;
            return response()->json([
                'status' => [
                    'code' => $status,
                    'message'   => 'Invalid Request Parameter',
                ],
                'extra'     => $invParam
            ], $status);
        });

        // 権限エラー
        Response::macro('Forbidden', function ($invParam = '') {
            $status = 403;
            return response()->json([
                'status' => [
                    'code' => $status,
                    'message'   => 'Invalid Request Parameter',
                ],
                'extra'     => $invParam
            ], $status);
        });

        Response::macro('notFound', function ($message) {
            $status = 404;
            return response()->json([
                'status' => [
                    'code' => $status,
                    'message'   => $message,
                ],
            ], $status);
        });

        Response::macro('internalError', function ($message) {
            $status = 500;
            return response()->json([
                'status' => [
                    'code' => $status,
                    'message'   => $message,
                ],
            ], $status);
        });
    }
}
