<?php

namespace App\UseCases\Supporter\WorkImage;

use App\Models\SupporterWorksImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateAllUseCase
{
    public function __invoke($data, $supporterId)
    {
        // イメージ削除
        $retainImageIds = collect($data)->pluck('id');
        $deletedImages = SupporterWorksImage::where('supporter_user_id', $supporterId)
            ->whereNotIn('id', $retainImageIds);
        Storage::disk('public')->delete($deletedImages->pluck('image_path'));
        $deletedImages->delete();
        // イメージ更新
        for ($i = 0; $i < count($data); $i++) {
            if (array_key_exists('id', $data[$i])) {
                // 更新
                $workImage = SupporterWorksImage::where('supporter_user_id', Auth::id())
                    ->where('id', $data[$i]['id'])
                    ->first();
                $workImage->fill($data[$i]);
                $workImage->save();
            } else {
                // 作成
                $data[$i]['supporter_user_id'] = Auth::id();
                SupporterWorksImage::create($data[$i]);
            }
        }
    }
}
