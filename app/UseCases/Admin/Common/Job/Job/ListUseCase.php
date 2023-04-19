<?php

namespace App\UseCases\Admin\Common\Job\Job;

use App\Models\Job;

class ListUseCase
{
    public function __invoke($post_data)
    {
        $job = Job::query();
        $data = [];
        //検索

        //日付
        $job -> when((isset($post_data['start_at_lower_limit']) || isset($post_data['start_at_upper_limit'])),function ($query) use ($post_data){
            return $query->whereHas('jobReservationSummary',function($query) use ($post_data){
                if(isset($post_data['start_at_lower_limit']))$query = $query->where('start_at','>=',$post_data['start_at_lower_limit']);
                if(isset($post_data['start_at_upper_limit']))$query = $query->where('start_at','<=',$post_data['start_at_upper_limit']);
                return $query;
            })->orWhereHas('preQuotation',function($query) use ($post_data){
                if(isset($post_data['start_at_lower_limit']))$query = $query->where('support_start_at','>=',$post_data['start_at_lower_limit']);
                if(isset($post_data['start_at_upper_limit']))$query = $query->where('support_start_at','<=',$post_data['start_at_upper_limit']);
                return $query;
            })->orWhereHas('jobRequest',function($query) use ($post_data){
                if(isset($post_data['start_at_lower_limit']))$query = $query->where('support_start_at','>=',$post_data['start_at_lower_limit']);
                if(isset($post_data['start_at_upper_limit']))$query = $query->where('support_start_at','<=',$post_data['start_at_upper_limit']);
                return $query;
            });
        });
        //公開応募ID?
        $job -> when(isset($post_data['job_id']),function ($query) use ($post_data){
            return $query->where('id',$post_data['job_id']);
        });
        //ステータス
        $job -> when(isset($post_data['status']),function ($query) use ($post_data){
            return $query->where('status',$post_data['status']);
        });
        //パークサポーター
        $job -> when(isset($post_data['supporter']),function ($query) use ($post_data){
            return $query->whereHas('supporterUser',function($query) use ($post_data){
                $supporter = $post_data['supporter'];
                return $query->whereIn('id',[$supporter])
                ->orWhere(function ($query) use ($supporter) {
                    $query->where(function ($query) use ($supporter){
                        $query->where('last_name','LIKE',"%{$supporter}%")
                        ->orWhere('first_name','LIKE',"%{$supporter}%")
                        ->orWhereRaw('CONCAT(last_name,"",first_name) LIKE ?',"%{$supporter}%");
                    })->orWhere(function ($query) use ($supporter){{
                        $query->where('last_kana','LIKE',"%{$supporter}%")
                        ->orWhere('first_kana','LIKE',"%{$supporter}%")
                        ->orWhereRaw('CONCAT(last_kana,"",first_kana) LIKE ?',"%{$supporter}%");
                    }});
                })                ;
            });
        });
        //定/単
        $job -> when(isset($post_data['job_contents']),function ($query) use ($post_data){
            $status = config('api.common.job_content');
            switch($post_data['job_contents']){
                case 0:
                    $contents = [
                        $status['web_interview'],
                        $status['in_person_interview'],
                        $status['single']
                    ];
                    break;
                case 1:
                    $contents = [$status['regular']];
                    break;
                default:
                    $contents = $status;
                    break;
            }
            return $query->whereHas('jobReservationSummary',function($query) use ($post_data){
                return $query->whereIn('request_category',$contents);
            })->orWhereHas('jobRequest',function($query) use ($post_data){
                return $query->whereIn('request_category',$contents);
            });
        });
        //ユーザー
        $job -> when(isset($post_data['user']),function ($query) use ($post_data){
            return $query->whereHas('guardianUser',function($query) use ($post_data){
                $user = $post_data['user'];
                return $query->whereIn('id',[$user])
                ->orWhere(function ($query) use ($post_data) {
                    $query->where(function ($query) use ($user){
                        $query->where('last_name','LIKE',"%{$user}%")
                        ->orWhere('first_name','LIKE',"%{$user}%")
                        ->orWhereRaw('CONCAT(last_name,"",first_name) LIKE ?',"%{$user}%");
                    })->orWhere(function ($query) use ($user){{
                        $query->where('last_kana','LIKE',"%{$user}%")
                        ->orWhere('first_kana','LIKE',"%{$user}%")
                        ->orWhereRaw('CONCAT(last_kana,"",first_kana) LIKE ?',"%{$user}%");
                    }});
                });
            });
        });
        //依頼カテゴリー
        $job -> when(isset($post_data['category']),function ($query) use ($post_data){
            return $query->whereHas('jobReservationSummary',function($query) use ($post_data){
                return $query->where('request_category',$post_data['category']);
            })->orWhereHas('jobRequest',function($query) use ($post_data){
                return $query->where('request_category',$post_data['category']);
            });
        });
        //都道府県
        $job -> when(isset($post_data['prefecture']),function ($query) use ($post_data){
            return $query->whereHas('guardianUser',function($query) use ($post_data){
                return $query->where('prefecture',$post_data['prefecture']);
            });
        });
        //見守り
        $job -> when(isset($post_data['monitaring']),function ($query) use ($post_data){
            switch($post_data['monitaring']){
                case 0:
                    return $query->doesntHave('jobMonitaring');
                case 1:
                    return $query->has('jobMonitaring');
                default:
                    return $query;
            }
        });
        $job = $job->get();
        //データ取得
        $data = $job->flatMap(function($item, $key){
            $status = config('api.common.job_status');
            $data = collect();
            //お仕事ID
            $data->put('job_id',$item->id);
            //開始
            //終了
            if($item->jobReservationSummary){
                $data->put('start_at',$item->jobReservationSummary->start_at);
                $data->put('end_at',$item->jobReservationSummary->end_at);
            }else if($item->preQuotation){
                $data->put('start_at',$item->preQuotation->support_start_at);
                $data->put('end_at',$item->preQuotation->support_end_at);
            }else if($item->jobRequest){
                $data->put('start_at',$item->jobRequest->support_start_at);
                $data->put('end_at',$item->jobRequest->support_end_at);
            }else{
                $data->put('start_at','');
                $data->put('end_at','');          
            }
            //パークサポーター
            $data->put('supporter_user',$item->supporterUser->only([
                'id',//サポーターID
                'first_name',//名前
                'last_name',//姓
                'first_kana',//名前 ふりがな
                'last_kana',//姓 ふりがな
            ]));
            //ユーザー
            $data->put('guardian_user',$item->guardianUser->only([
                'id',//保護者ID
                'first_name',//名前
                'last_name',//姓
                'first_kana',//名前 ふりがな
                'last_kana',//姓 ふりがな
            ]));
            //定/単
            if($item->jobReservationSummary){
                $data->put('job_content',$item->jobReservationSummary->job_content);
            }else if($item->preQuotation){
                $data->put('job_content',$item->preQuotation->job_content);
            }else{
                $data->put('job_content','');
            }
            //依頼カテゴリー
            if($item->jobReservationSummary){
                $data->put('request_category',$item->jobReservationSummary->request_category);
            }else if($item->preQuotation){
                $data->put('request_category',$item->preQuotation->request_category);
            }else{
                $data->put('request_category','');
            }
            //都道府県
            $data->put('prefecture',$item->guardianUser->prefecture);
            //見守り
            if($item->jobReservationSummary){
                $data->put('is_monitaring',$item->jobReservationSummary->monitaring_id);
            }else if($item->preQuotation){
                $data->put('is_monitaring',$item->preQuotation->is_monitarings);
            }else{
                $data->put('is_monitaring',0);
            }
            //ステータス
            $data->put('staus',$item->status);
            //メモ
            $data->put('note',$item->note);
            return [$data->toArray()];
        });
        return $data->toArray();
    }
}
