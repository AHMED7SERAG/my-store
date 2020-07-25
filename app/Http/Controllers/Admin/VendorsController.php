<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Main_category;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index()
    {
       $vendors = Vendor::with('category')-> selection()->paginate(PAGINATION_COUNT);
       return view('admin.vendors.index',compact('vendors'));
    }
    public function create()
    {
        $categories= Main_category::Active()->where('translation_lang',default_lang())->get();
        return view('admin.vendors.create',compact('categories'));
        
    }
    public function edit($id)
    {
        
    }
    public function update($id ,Request $request)
    {
        
    }
    public function destroy($id )
    {
        
    }
}
