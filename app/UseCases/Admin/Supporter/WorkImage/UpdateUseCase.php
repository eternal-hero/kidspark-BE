<?php

namespace App\UseCases\Admin\Supporter\WorkImage;

use App\Models\SupporterWorksImage;
use Illuminate\Support\Facades\Storage;


class UpdateUseCase
{
    public function __invoke($request, $supporter_user_id, $works_image_id)
    {
        $work_image = SupporterWorksImage::where('supporter_user_id', $supporter_user_id)
            ->where('id', $works_image_id)
            ->first();

        $data = $request->validated();
        if ($request->file('image')) {
            $newImage = Storage::disk('public')->putFile('supporter_works_images', $request->file('image'));
            Storage::disk('public')->delete($work_image->image_path);
            $data['image_path'] = $newImage;
        } else {
            if (empty($data['image_path'])) {
                Storage::disk('public')->delete($work_image->image_path);
            }
        }

        $work_image->fill($data);
        $work_image->save();
        return $work_image;
    }
}
