<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function store(Request $request)
    {
        return Storage::disk('public')->putFile('supporter', $request->file('file'));
    }
    public function upload(Request $request){
        $fileinfo = pathinfo($request->file('file')->getClientOriginalName());
        $file_name = $this->getUniquePath($request->upload_path,$fileinfo);
        $upload_path = $request->upload_path;
        $path = $request->file('file')->storeAs('public/' . $upload_path,$file_name);
        return response()->ok($upload_path . '/' . $file_name);
    }
    public function delete(Request $request){
        $delete_path = $request->delete_path;
        Storage::delete($delete_path);
        return response()->ok();
    }

    private function getUniquePath($upload_path, $fileinfo){
        $file_name = uniqid()."_".date("YmdHis").'.'.$fileinfo['extension'];
        if(Storage::disk('local')->missing($upload_path.'/'.$file_name)){
            return $file_name;
        }
        return $this->getUniquePath($upload_path,$fileinfo);
    }

     public function uploadArrayFiles(array $files,$upload_path){
        $paths = [];
        foreach($files as $file){
            $fileinfo = pathinfo($file->getClientOriginalName());
            $file_name = $this->getUniquePath($upload_path,$fileinfo);
            $path = $file->storeAs("public/".$upload_path,$file_name,'local');
            $paths[] = $path;
        }
        return $paths;
    }

}
