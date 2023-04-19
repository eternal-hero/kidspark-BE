<?php

namespace App\UseCases\Admin\Guardian\User;

use Illuminate\Database\Eloquent\Builder;
use App\Models\GuardianUser;

class IndexUseCase
{
    public function __invoke($data)
    {
        if ($data) {
            $guardian_user = new GuardianUser();
            //ユーザー
            if (array_key_exists('user', $data) && ($data['user'])) {
                $param = $data['user'];
                $keywords = $this->extractKeywords($param);
                //id検索
                $guardian_user = $guardian_user->whereIn('id', $keywords)
                    //名前検索
                    ->orWhere(function ($base_query) use ($keywords) {
                        foreach ($keywords as $keyword) {
                            $base_query->where(function ($query) use ($keyword) {
                                $query->where('last_name', 'LIKE', "%{$keyword}%")
                                    ->orWhere('first_name', 'LIKE', "%{$keyword}%")
                                    ->orWhereRaw('CONCAT(last_name,"",first_name) LIKE ?', "%{$keyword}%");
                            })->orWhere(function ($query) use ($keyword) { {
                                    $query->where('last_kana', 'LIKE', "%{$keyword}%")
                                        ->orWhere('first_kana', 'LIKE', "%{$keyword}%")
                                        ->orWhereRaw('CONCAT(last_kana,"",first_kana) LIKE ?', "%{$keyword}%");
                                }
                            });
                        }
                    });
            }
            //都道府県
            if (array_key_exists('prefecture', $data)) {
                $guardian_user = $guardian_user->where('prefecture', $data['prefecture']);
            }
            //カメラ有無
            if (array_key_exists('is_camera', $data)) {
                switch ($data['is_camera']) {
                    case '0':
                        $guardian_user = $guardian_user->where('is_camera', '0');
                        break;
                    case '1':
                        $guardian_user = $guardian_user->where('is_camera', '1');
                        break;
                    default:
                        break;
                }
            }
            //緊急連絡先
            if (array_key_exists('emergency_contact_phone_number', $data)) {
                $guardian_user = $guardian_user->where('emergency_contact_phone_number', 'LIKE', $data['emergency_contact_phone_number']);
            }
            if (array_key_exists('child_age', $data)) {
                $dataValue = $data['child_age'];
                for ($i = 0; $i < count($dataValue); $i++) {
                    $age = $dataValue[$i];
                    if ($i == 0) {
                        $guardian_user = $guardian_user->where(function ($query01) use ($age) {
                            $query01 = $this->makeChildAgeFromArray($query01, $age);
                        });
                    } else {
                        $guardian_user = $guardian_user->orWhere(function ($query01) use ($age) {
                            $query01 = $this->makeChildAgeFromArray($query01, $age);
                        });
                    }
                }
            }
            return $guardian_user->with('children')->with('guardianProfile')->get();
        } else {
            return GuardianUser::all();
        }
    }

    private function makeChildAgeFromArray($query01, $age){
        switch ($age) {
            case 0:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-1 month")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("0 month")));
                });
                break;
            case 1:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-3 month")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("-1 month")));
                });
                break;
            case 2:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-6 month")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("-3 month")));
                });
                break;
            case 3:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-1 year")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("-6 month")));
                });
                break;
            case 4:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-2 year")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("-1 year")));
                });
                break;
            case 5:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-3 year")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("-2 year")));
                });
                break;
            case 6:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '>', date('Y-m-d', strtotime("-7 year")))
                        ->where('birthday', '<=', date('Y-m-d', strtotime("-3 year")));
                });
                break;
            case 7:
                $query01 = $query01->whereHas('children', function ($query) {
                    $query->where('birthday', '<=', date('Y-m-d', strtotime("-7 year")));
                });
            default:
                break;
        }
        return $query01;
    }
    private function extractKeywords(string $input, int $limit = -1): array
    {
        return array_values(array_unique(preg_split('/[\p{Z}\p{Cc}]++/u', $input, $limit, PREG_SPLIT_NO_EMPTY)));
    }
}
