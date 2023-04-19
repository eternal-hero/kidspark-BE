<?php

namespace App\Http\Controllers\Supporter\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supporter\Setting\OptionRequests as OptionRequests;
use App\UseCases\Supporter\Setting\Option\SearchUseCase as OptionSearch;
use App\UseCases\Supporter\Setting\Option\StoreUseCase as OptionStore;
use App\UseCases\Supporter\Setting\Option\UpdateUseCase as OptionUpdate;
use App\UseCases\Supporter\Setting\Option\UpdateAllUseCase;
use App\UseCases\Supporter\Setting\Option\DeleteUseCase as OptionDelete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    public function index(OptionRequests\IndexRequest $request)
    {
        $supporter_user_id = Auth::id();
        $supporterOptions = (new OptionSearch)($supporter_user_id, $request->query('option_id'), $request->query('settings_id'));
        return response()->ok($supporterOptions);
    }

    public function store(OptionRequests\StoreRequest $request)
    {
        $supporter_user_id = Auth::id();
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

    public function update(OptionRequests\UpdateRequest $request, $option_id)
    {
        $supporter_user_id = Auth::id();
        $update = [
            'subject_type' => $request->subject_type,
            'option_content' => $request->option_content,
            'additional_fee' => $request->additional_fee,
            'unit' =>  $request->unit
        ];
        $option = (new Optionupdate)($update, $supporter_user_id, $option_id);
        return response()->ok($option);
    }

    public function destroy($option_id = null)
    {
        $supporter_user_id = Auth::id();
        (new OptionDelete)($supporter_user_id, $option_id);
        return response()->ok();
    }

    public function update_all(OptionRequests\UpdateAllRequest $request)
    {
        $supporter_user_id = Auth::id();
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
