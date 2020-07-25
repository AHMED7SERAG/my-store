<?php

use App\Models\Language;

function get_languages(){
   return Language::Active()->Selection()->get();
}
 function default_lang()
{
  return config('app.locale');
}
 function saveImage($folder ,$image)
{
    $image->store('/',$folder);
    $file_name=$image->hashName();
    $path='images/'.$folder.'/'.$file_name;
    return $path;
}