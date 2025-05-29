<?php

namespace App\Http\Controllers;
error_reporting(E_ALL);
ini_set('display_errors', 1);
//use App\Http\Controllers\UploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
/*
 * jQuery File Upload Plugin PHP Class
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 * 
 */

class UploadController extends Controller {
  public function upload(Request $request){
    try {
      $request->validate([
        'upload_type' => 'required',
        'file' => 'required|max:10240|mimes:doc,docx,png,jpeg,pdf,xlsx,xls,ppt,pptx,txt'
      ]);

      if (!\Storage::disk('public')->exists('school-'.\Auth::user()->school_id)) {
        \Storage::disk('public')->makeDirectory('school-'.\Auth::user()->school_id);
      }

      $upload_dir = 'school-'.\Auth::user()->school_id.'/'.date("Y").'/'.$request->upload_type;
      
      if (!\Storage::disk('public')->exists($upload_dir)) {
        \Storage::disk('public')->makeDirectory($upload_dir);
      }

      $path = \Storage::disk('public')->putFile($upload_dir, $request->file('file'));
      
      if(!$path) {
        return response()->json([
          'imgUrlpath' => null,
          'path' => null,
          'error' => 'Falha ao salvar o arquivo. Por favor, tente novamente.'
        ]);
      }
      
      if($request->upload_type == 'notice'){
        $request->validate([
          'title' => 'required|string',
        ]);
        $tb = new \App\Notice;
        $tb->file_path = 'storage/'.$path;
        $tb->title = $request->title;
        $tb->active = 1;
        $tb->school_id = \Auth::user()->school_id;
        $tb->user_id = \Auth::user()->id;
        $tb->save();
      }else if($request->upload_type == 'event'){
        $request->validate([
          'title' => 'required|string',
        ]);
        $tb = new \App\Event;
        $tb->file_path = 'storage/'.$path;
        $tb->title = $request->title;
        $tb->active = 1;
        $tb->school_id = \Auth::user()->school_id;
        $tb->user_id = \Auth::user()->id;
        $tb->save();
      } else if($request->upload_type == 'routine'){
        $request->validate([
          'title' => 'required|string',
        ]);
        $tb = new \App\Routine;
        $tb->file_path = 'storage/'.$path;
        $tb->title = $request->title;
        $tb->active = 1;
        $tb->school_id = \Auth::user()->school_id;
        $tb->user_id = \Auth::user()->id;
        $tb->save();
      } else if($request->upload_type == 'syllabus'){
        $request->validate([
          'title' => 'required|string',
        ]);
        $tb = new \App\Syllabus;
        $tb->file_path = 'storage/'.$path;
        $tb->title = $request->title;
        $tb->active = 1;
        $tb->school_id = \Auth::user()->school_id;
        $tb->user_id = \Auth::user()->id;
        $tb->save();
      } else if($request->upload_type == 'profile' && $request->user_id > 0){
        $tb = \App\User::find($request->user_id);
        if(!$tb) {
          return response()->json([
            'imgUrlpath' => null,
            'path' => null,
            'error' => 'Usuário não encontrado.'
          ]);
        }
        $tb->pic_path = 'storage/'.$path;
        $tb->save();
      }

      return response()->json([
        'imgUrlpath' => url('storage/'.$path),
        'path' => 'storage/'.$path,
        'error' => false
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'imgUrlpath' => null,
        'path' => null,
        'error' => $e->getMessage()
      ]);
    }
  }
}
