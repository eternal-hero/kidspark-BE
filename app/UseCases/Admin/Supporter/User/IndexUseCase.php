<?php

namespace App\UseCases\Admin\Supporter\User;

use App\Models\SupporterUser;

class IndexUseCase
{
    public function __invoke($data)
    {
        $supporter_user = SupporterUser::select([
            'user.id',
            'user.first_name',
            'user.last_name',
            'user.first_kana',
            'user.last_kana',
            'user.gender',
            'user.prefecture',
            'user.status',
            'user.supporter_id',
            'supporter.is_supporter',
            'childbirth_care.is_childbirth_care',
            'sick_child_care.is_sick_child_care',
            'housework.is_housework',
            'user.memo'
        ])
        ->from('supporter_users as user')
        //*/
        ->leftjoin('supporter_settings as supporter',function($join){
            $join->on('user.id', '=', 'supporter.supporter_user_id');
        })
        ->leftjoin('childbirth_care_settings as childbirth_care',function($join){
            $join->on('childbirth_care.supporter_user_id', '=', 'user.id');
        })
        ->leftjoin('sick_child_care_settings as sick_child_care',function($join){
            $join->on('sick_child_care.supporter_user_id', '=', 'user.id');
        })
        ->leftjoin('housekeeping_settings as housework',function($join){
            $join->on('housework.supporter_user_id', '=', 'user.id');
        });
        //*/
        if($data){
            //パークサポーター
            if(array_key_exists('supporter',$data)&&($data['supporter'])){
                $param = $data['supporter'];
                $keywords = $this->extractKeywords($param);
                //id検索
                $supporter_user = $supporter_user->whereIn('user.id',$keywords)
                //名前検索
                ->orWhere(function ($base_query) use ($keywords) {
                    foreach($keywords as $keyword){
                        $base_query->where(function ($query) use ($keyword){
                            $query->where('user.last_name','LIKE',"%{$keyword}%")
                            ->orWhere('user.first_name','LIKE',"%{$keyword}%")
                            ->orWhereRaw('CONCAT(user.last_name,"",user.first_name) LIKE ?',"%{$keyword}%");
                        })->orWhere(function ($query) use ($keyword){{
                            $query->where('user.last_kana','LIKE',"%{$keyword}%")
                            ->orWhere('user.first_kana','LIKE',"%{$keyword}%")
                            ->orWhereRaw('CONCAT(user.last_kana,"",user.first_kana) LIKE ?',"%{$keyword}%");
                        }});
                    }
                });
            }
            //稼働実績
            //都道府県
            if(array_key_exists('prefecture',$data))$supporter_user = $supporter_user->where('user.prefecture',$data['prefecture']);
            //性別
            if(array_key_exists('gender',$data)){
                switch($data['gender']){
                    case 0:
                    case 1:
                        if($data['gender'])$supporter_user = $supporter_user->where('user.gender',$data['gender']);
                        break;
                    default:
                        break;
                }
            }
            //個人ステータス
            if(array_key_exists('status',$data)){
                switch($data['status']){
                    case 0:
                    case 1:
                    case 2:
                        if($data['status'])$supporter_user = $supporter_user->where('user.status',$data['status']);
                        break;
                    default:
                        break;
                }
            }
            //シッター
            if(array_key_exists('is_supporter',$data)){
                switch($data['is_supporter']){
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                        if($data['is_supporter'])$supporter_user = $supporter_user->where('supporter.is_supporter',$data['is_supporter']);
                        break;
                    default:
                        break;
                }
            }
            //病児保育
            if(array_key_exists('is_sick_child_care',$data)){
                switch($data['is_sick_child_care']){
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                        if($data['is_sick_child_care'])$supporter_user = $supporter_user->where('sick_child_care.is_sick_child_care',$data['is_sick_child_care']);
                        break;
                    default:
                        break;
                }
            }
            //産前産後
            if(array_key_exists('is_childbirth_care',$data)){
                switch($data['is_supporter']){
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                        if($data['is_childbirth_care'])$supporter_user = $supporter_user->where('childbirth_care.is_childbirth_care',$data['is_childbirth_care']);
                        break;
                    default:
                        break;
                }
            }
            //家事代行
            if(array_key_exists('is_housework',$data)){
                switch($data['is_housework']){
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                        if($data['is_housework'])$supporter_user = $supporter_user->where('housework.is_housework',$data['is_housework']);
                        break;
                    default:
                        break;
                }
            }
        }
        if(array_key_exists('page',$data)){
            $supporter_user =  $supporter_user->paginate(config('api.common.paginate_item_num.supporter_users'));
        }else{
            $supporter_user =  $supporter_user->get();
        }
        return $supporter_user;
    }
    private function extractKeywords(string $input, int $limit = -1): array
    {
        return array_values(array_unique(preg_split('/[\p{Z}\p{Cc}]++/u', $input, $limit, PREG_SPLIT_NO_EMPTY)));
    }
}
