<?php

namespace App\UseCases\Admin\Common\Job\Job;

use App\Models\Job;

class ReportUseCase
{
    public function __invoke($job_id)
    {
        $job = Job::find($job_id);
        $data = [];
        //レポート
        $completion_report = $job->completionReport;
        $report_contents = collect();
        $contents_items = $completion_report->reportContent;
        if($contents_items){
            foreach($contents_items as $contents_item){
                $report_contents->push($contents_item->only([
                    'contents_type',//項目の種類
                    'contents_detail' //内訳、詳細
                ]));
            }
            $report_contents = $report_contents->map(function($item, $key){
                if($item['contents_type'] == config('api.common.report_content_item.image')){
                    $item['contents_detail'] = json_decode($item['contents_detail'],true);
                }
                return $item;
            })->sortBy('contents_type')->toArray();
        }
        $data['report'] = $report_contents;
        //レビュー
        $review_items = $job->review;
        $review_contents = [];
        if($review_items){
            foreach($review_items as $review_item){
                $review_contents[] = $review_item->only([
                    'reviewer_id',//レビュアーID
                    'reviewer_type',//レビュアーの種類
                    'icon',//レビューアイコン
                    'rating',//評価
                    'review_content', //レビュー本文
                    'is_publish'//公開するかのフラグ
                ]);
            }
        }
        $data['review'] = $review_contents;
        return $data;
    }
}
