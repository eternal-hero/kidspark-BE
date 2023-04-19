<?php

namespace App\UseCases\Guardians\Job;

use App\Models\EstimatedAmount;
use App\Models\Job;
use App\Models\JobRequest;
use App\Models\SupportPlace;
use App\Models\SupportPlaceImage;
use Illuminate\Support\Facades\DB;

class CreateUseCase
{
    public function __invoke($guardian_user_id, $request)
    {
        try {
            DB::beginTransaction();
            $job_data = [
                'supporter_user_id' => $request['supporter_user_id'],
                'guardian_user_id' => $guardian_user_id,
                'status' => 1,
            ];
            
            $job = Job::create($job_data);

            $estimated_amounts_data = [
                'basic_fee' => $request['estimated_amounts']['basic_fee'],
                'option_fee' => $request['estimated_amounts']['option_fee'],
                'transportation_fee' => $request['estimated_amounts']['transportation_fee'],
                'commission_fee' => $request['estimated_amounts']['commission_fee'],
                'total' => $request['estimated_amounts']['basic_fee'] + 
                    $request['estimated_amounts']['option_fee'] +
                    $request['estimated_amounts']['transportation_fee'] +
                    $request['estimated_amounts']['commission_fee'], 
            ];
            $estimated_amounts = EstimatedAmount::create($estimated_amounts_data);

            $job_request_data = [
                'job_id' => $job->id,
                'request_category' => $request['category'],
                'request_content' => $request['content_type'],
                'support_date_on' => explode(' ', $request['start_at'])[0],
                'support_start_at' => $request['start_at'],
                'support_end_at' => $request['end_at'],
                'detail' => $request['contents'],
                'is_monutarings' => 0,
                'estimated_amounts_id' => $estimated_amounts->id,
            ];
            $job_request = JobRequest::create($job_request_data);

            if($request['is_my_home'] == 0) {
                $support_place_data = [
                    'job_id' => $job->id,
                    'address' => $request['support_place']['address'] ? $request['support_place']['address'] : null,
                    'near_line' => $request['support_place']['near_line'],
                    'near_station' => $request['support_place']['near_station'],
                    'means' => $request['support_place']['means'],
                    'travel_time' => $request['support_place']['travel_time'],
                    'way_to_get_home' => $request['support_place']['way_to_get_home'] ? $request['support_place']['way_to_get_home'] : null,
                ];
                $support_place = SupportPlace::create($support_place_data);
                if($request['support_place']['images']) {
                    $image_data = [];
                    foreach($request['support_place']['images'] as $data) {
                        $image_data[] = [
                            'support_place_id' => $support_place->id,
                            'file_path' => $data['path']
                        ];
                    }
                    SupportPlaceImage::insert($image_data);
                }
            }
            DB::commit();
            return $job;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
