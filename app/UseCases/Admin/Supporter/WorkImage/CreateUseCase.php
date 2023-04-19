<?php

namespace App\UseCases\Admin\Supporter\WorkImage;

use App\Models\SupporterWorksImage;
use Illuminate\Support\Facades\Storage;

class CreateUseCase
{
    public function __invoke($data, $request)
    {
        if ($request->file('image')) {
            $newImage = Storage::disk('public')->putFile('supporter_works_images', $request->file('image'));
            $data['image_path'] = $newImage;
        }
        return SupporterWorksImage::create($data);
    }
}
