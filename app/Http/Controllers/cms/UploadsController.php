<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Gallery;
use DB;
use File;

class UploadsController extends BaseController {

    public function upload(Request $request) {
        
        if($request->hasFile('upload')) {
            $uploaded_file = $request->upload;
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
 
            $originName = $uploaded_file->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $uploaded_file->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
 
             // images
             if ( ( in_array($uploaded_file->getMimeType(),  ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml']))) {
                $uploaded_file->move(public_path('uploads/text-editor/images'), $fileName);
                $url = asset('uploads/text-editor/images/'.$fileName);
                $msg = 'Image uploaded successfully';

                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                @header('Content-type: text/html; charset=utf-8');
                echo $response;
                
             }
             else{
               // documents
                $uploaded_file->move(public_path('uploads/text-editor/files'), $fileName);
                $url = asset('uploads/text-editor/files/'.$fileName);
                $msg = 'File uploaded successfully';

                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                @header('Content-type: text/html; charset=utf-8');
                echo $response;
             }
 
            
        }

    }


    public function deleteFile(Request $request) {

        $file = $request->file('file');

        if($file){
            $file = parse_url(json_decode($file),PHP_URL_PATH);
            $file_path=public_path().$file;
            if (file_exists($file_path)) {
                    unlink($file_path);
            }
        }
        
    }


    // getimage
    public function getImages(Request $request)
    {
        // dd($request->all());
        $galleries = Gallery::where('type','photos')->with('photos')->get();
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');

        // get the uploaded images too
        $uploaded_images = $this->getUploadedImages();

        // get the uploaded files too
        $uploaded_files = $this->getFiles();
        
        return view('cms.uploads.index', compact('galleries','CKEditorFuncNum','uploaded_images','uploaded_files'));
    }


    // not used for current ckeditor4 ... for files and images both use upload()
    public function upload_file(Request $request){

        $file = $request->file('file');

        $name = $file->getClientOriginalName();

        $file->move(public_path().'/uploads/text-editor/files/', $name);

        $array = array(
            'filelink' => asset('uploads/text-editor/files/'.$name),
            'filename' => self::getFileName($name)
        );

        echo stripslashes(json_encode($array));

    }


    public function getUploadedImages()
    {
        $path = public_path().'/uploads/text-editor/images/';
        $files = array();
        $array=array();

        if(file_exists($path)){
            $dir = dir($path);

            while (false !== ($entry = $dir->read())) {
                if ($entry != '.' && $entry != '..' &&  $entry != "error" && $entry != "stats" ) {
                if (!is_dir($path . '/' .$entry)) {
                        array_push($files, $entry);
                }
                }
            }

            foreach ($files as $file) {

                $array[] = array(
                    'title' => self::getFileName($file), //some image
                    'name' => $file, //image.jpg
                    'link' => asset('/uploads/text-editor/images/'.$file), //link
                    'size' => self::fileSizer(File::size($path.'/'.$file)), //size
                );
            }
        }

        return $array;
        // echo stripslashes(json_encode($array));
        
    }
    
    
    public function getFiles()
    {
        $path = public_path().'/uploads/text-editor/files/';
        $files = array();
        $array=array();

        if(file_exists($path)){
            $dir = dir($path);

            while (false !== ($entry = $dir->read())) {
                if ($entry != '.' && $entry != '..' &&  $entry != "error" && $entry != "stats" ) {
                if (!is_dir($path . '/' .$entry)) {
                        array_push($files, $entry);
                }
                }
            }

            foreach ($files as $file) {

                $array[] = array(
                    'title' => self::getFileName($file), //some image
                    'name' => $file, //image.jpg
                    'link' => asset('/uploads/text-editor/files/'.$file), //link
                    'size' => self::fileSizer(File::size($path.'/'.$file)), //size
                );
            }
        }

        return $array;
        // echo stripslashes(json_encode($array));
        
    }

    public static function fileSizer($size){

        $size = $size/1024;
            if(round($size) >= 1024){
                return round($size/(1024))." Mb";
            } else {
                return round($size)." Kb";
            }

    }

    public static function getFileName($file){
        $position = strripos($file,'.');
        $filename = substr($file,0,($position));

        $filename = strtolower(str_replace('-',' ', str_replace('_', ' ', $filename)));
        return $filename;
    }

}
