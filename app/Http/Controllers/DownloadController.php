<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
   public function downloadAttachedFiles($filename)
   {
      $path = storage_path("app/public/attached_files/{$filename}");
      return response()->download($path);
   }
}
