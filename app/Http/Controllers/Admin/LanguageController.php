<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\languageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
       $languages= Language::selection()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index',compact('languages'));
    }
    public function create()
    {
        return view('admin.languages.create');
    }
    public function store(languageRequest $request)
    {
       
        try{
           
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success'=> 'تم الحفظ بنجاح ']);

        }catch(\Exception $ex){
            return redirect()->route('admin.languages')->with(['error'=> ' لقد حدثت مشكلة اثناء الحفظ . يرجى المحاولة لاحقا']);


        }
    }
    public function edit($id)
        {
            $language =Language::find($id);
            if(!$language){
                return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجوده']);
            }
          
            return view('admin.languages.edit',compact('language'));
        }
    public function update(languageRequest $request ,$id)
        {
            
           
            
            try{
                
                $language =Language::find($id);
                if(!$language){
                  return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجوده']);
                }
                if(!$request->has('active')){
                    $request->request->add(['active'=>'0']);
                }
             
                $language->update($request->except(['_token']));
                return redirect()->route('admin.languages')->with(['success'=> ' تم التحديث  بنجاح ']);
            }
            catch(\Exception $ex){
                return redirect()->route('admin.languages')->with(['error'=> ' لقد حدثت مشكلة اثناء الحفظ . يرجى المحاولة لاحقا']);

            }
        
        }
        public function destroy($id)
        {
            
           
            
            try{
                $language =Language::find($id);
                if(!$language){
                  return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجوده']);
                }
                $language->delete();
                return redirect()->route('admin.languages')->with(['success'=> ' تم الحذف  بنجاح ']);
            }
            catch(\Exception $ex){
                return redirect()->route('admin.languages')->with(['error'=> ' لقد حدثت مشكلة اثناء الحفظ . يرجى المحاولة لاحقا']);

            }
        
        }
       
      
        
    
}
