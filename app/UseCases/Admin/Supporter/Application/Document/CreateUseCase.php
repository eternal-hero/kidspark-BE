<?php

namespace App\UseCases\Admin\Supporter\Application\Document;

use App\Models\SupporterApplicationDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $appDocument = new SupporterApplicationDocument();
        $appDocument->fill($requestData);
        $appDocument->supporter_user_id = $supporter_user_id;
        $appDocument->application_at = Carbon::now();
        DB::beginTransaction(); 
        try{
            $appDocument->save();
            $appDocument->file_id = str_pad($appDocument->id, 6, '0', STR_PAD_LEFT);
            $appDocument->save();
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
        }
        return $appDocument;
    }
}
