<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Language;
use App\Models\Main_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MainCategoriesController extends Controller
{
        public function index()
        {
            $main_categories=Main_category::where('translation_lang','ar')->Selection()->get();
            return view('admin.mainCategories.index',compact('main_categories'));
        }
        public function create()
        {
            return view('admin.mainCategories.create');
            
        }
        public function store(MainCategoryRequest $request)
        {
            try{
                
                $main_category=collect($request->category);
                $filter= $main_category->filter(function($value ,$key){
                     return $value['abbr'] ==default_lang();
                 });
                $default_category=  array_values( $filter->all())[0];
     
                $file_path="";
                if($request->has('photo')){
                    $file_path=saveImage('main_categories',$request->photo);
                }
                DB::beginTransaction();
                 $default_categoryId=Main_category::insertGetId([
                 'translation_lang' => $default_category['abbr'],
                 'translation_of' => 0,
                 'name' => $default_category['name'],
                 'slug' => $default_category['name'],
                 'photo' =>$file_path,
                ]);
                 $categories= $main_category->filter(function($value ,$key){
     
                 return $value['abbr'] !=default_lang();
     
             });
             if(isset($categories) && $categories ->count() )
             {
                 $categories_arr=[];
                 foreach ($categories as $category) {
                     $categories_arr[]=['translation_lang' => $category['abbr'],
                       'translation_of' => $default_categoryId,
                          'name' => $category['name'],
                         'slug' => $category['name'],
                         'photo' =>$file_path];
             }
             Main_category::insert( $categories_arr);
             }
            
             DB::commit();
             return redirect()->route('admin.maincategories')->with(['success'=> 'تم الحفظ بنجاح ']);
            }
           
            catch(\Exception $ex){
                DB::rollback();
                return redirect()->route('admin.maincategories')->with(['error'=> ' لقد حدثت مشكلة اثناء الحفظ . يرجى المحاولة لاحقا']);
            }
           
    }
    public function edit($id)
    {
        // get category with its translation
        $main_category =Main_category::with('categories')-> selection()->find($id);
            if(!$main_category){
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجوده']);
            }
          
            return view('admin.maincategories.edit',compact('main_category'));
      
    }
    public function update(MainCategoryRequest $request ,$id)
    {
     
        try{
            if(!$request->has('category.0.active')){
                $request->request->add(['active'=>'0']);
            }else{
                $request->request->add(['active'=>'1']);
            }
            $main_category =Main_category::selection()->find($id);
            if(!$main_category){
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجوده']);
            }
            $category=  array_values( $request->category)[0];
            $file_path=$main_category->photo;
            if($request->has('photo')){
                $file_path=saveImage('main_categories',$request->photo);
            }
            $main_category->update([
              'name' => $category['name'],
              'active' => $request->active,
              'photo' => $file_path
          ]);
          return redirect()->route('admin.maincategories')->with(['success'=> 'تم التحديث بنجاح ']);

        }
        catch(\Exception $ex){
           
            return redirect()->route('admin.maincategories')->with(['error'=> ' لقد حدثت مشكلة اثناء التحديث . يرجى المحاولة لاحقا']);

        }
    }

    public function destroy($id)
        {
            
           
            
            try{
                $main_category =Main_category::find($id);
                if(!$main_category){
                  return redirect()->route('admin.maincategories')->with(['error' => 'هذه اللغة غير موجوده']);
                }
                $main_category->delete();
                return redirect()->route('admin.maincategories')->with(['success'=> ' تم الحذف  بنجاح ']);
            }
            catch(\Exception $ex){
                return redirect()->route('admin.maincategories')->with(['error'=> ' لقد حدثت مشكلة اثناء الحفظ . يرجى المحاولة لاحقا']);

            }
        
        }
}
