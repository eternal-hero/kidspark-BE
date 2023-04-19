<?php

namespace App\UseCases\Supporter\Application\Document;

use App\Models\SupporterApplicationDocument;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $appDocument = new SupporterApplicationDocument();
        $appDocument->fill($requestData);
        $appDocument->supporter_user_id = $supporter_user_id;
        DB::beginTransaction(); 
        try{
            $appDocument->save();
            $appDocument->file_id = str_pad($appDocument->id, 6, '0', STR_PAD_LEFT);
            $appDocument->save();
            DB::commit();
        } catch(Exception $e) {
            DB::rollback();
            dd($requestData,$appDocument,$e);
        }
        return $appDocument;
    }
}
