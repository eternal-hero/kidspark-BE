<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\OptionRequests as OptionRequests;
use App\UseCases\Admin\Supporter\Option\SearchUseCase as OptionSearch;
use App\UseCases\Admin\Supporter\Option\StoreUseCase as OptionStore;
use App\UseCases\Admin\Supporter\Option\UpdateUseCase as OptionUpdate;
use App\UseCases\Admin\Supporter\Option\DeleteUseCase as OptionDelete;
use App\UseCases\Supporter\Setting\Option\UpdateAllUseCase;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(OptionRequests\IndexRequest $request, $supporter_user_id)
    {
        $supporterOptions = (new OptionSearch)($supporter_user_id, $request->query('option_id'), $request->query('settings_id'));
        return response()->ok($supporterOptions);
    }

    public function store(OptionRequests\StoreRequest $request, $supporter_user_id)
    {
        $create = [
            'supporter_user_id' => $supporter_user_id,
            'settings_id' => $request->settings_id,
            'subject_type' => $request->subject_type,
            'option_content' => $request->option_content,
            'additional_fee' => $request->additional_fee,
            'unit' =>  $request->unit
        ];
        $supporterOption = (new OptionStore)($create, $supporter_user_id);
        return response()->ok($supporterOption);
    }

    public function update(OptionRequests\UpdateRequest $request, $supporter_user_id, $option_id)
    {
        $update = [
            'subject_type' => $request->subject_type,
            'option_content' => $request->option_content,
            'additional_fee' => $request->additional_fee,
            'unit' =>  $request->unit
        ];
        $option = (new Optionupdate)($update, $supporter_user_id, $option_id);
        return response()->ok($option);
    }

    public function destroy($supporter_user_id, $option_id = null)
    {
        (new OptionDelete)($supporter_user_id, $option_id);
        return response()->ok();
    }

    public function update_all(OptionRequests\UpdateAllRequest $request, $supporter_user_id)
    {
        foreach($request->toArray() as $data) {
            $posts[] = [
                'settings_id' => $data['settings_id'],
                'supporter_user_id' => $supporter_user_id,
                'subject_type' => $data['subject_type'],
                'option_content' => $data['option_content'],
                'additional_fee' => $data['additional_fee'],
                'unit' => $data['unit'],
            ];
        }
        (new UpdateAllUseCase)($posts,$supporter_user_id);
        return response()->ok();
    }
}
