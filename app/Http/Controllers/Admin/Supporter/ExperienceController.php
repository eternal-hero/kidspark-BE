<?php

namespace App\Http\Controllers\Admin\Supporter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\ExperienceRequests as ExperienceRequests;
use App\UseCases\Admin\Supporter\Experience as ExperienceUseCase;

class ExperienceController extends Controller
{
    public function store(ExperienceRequests\StoreRequest $request,ExperienceUseCase\CreateUseCase $createUC, $supporter_user_id)
    {
        $create = [
            'supporter_user_id' => $supporter_user_id,
            'parenting_experience' => $request->parenting_experience
        ];
        $supporter_experience = $createUC($create);
        return response()->created();
    }

    public function show(ExperienceUseCase\SearchUseCase $searchUC, $supporter_user_id)
    {
        $supporter_experience = $searchUC($supporter_user_id);
        return response()->ok($supporter_experience);
    }

    public function update(ExperienceRequests\UpdateRequest $request,ExperienceUseCase\UpdateUseCase $updateUC, $supporter_user_id)
    {
        $update = [
            'supporter_user_id' => $supporter_user_id,
            'parenting_experience' => $request->parenting_experience
        ];
        $supporter_experience = $updateUC($supporter_user_id,$update);
        return response()->ok();
    }

    public function destroy(ExperienceUseCase\DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $supporter_experience = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
