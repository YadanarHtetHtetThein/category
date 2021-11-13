<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        if(count($categories) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view('admin.category.index')->with(['categories'=>$categories, 'status'=>$emptyStatus]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'icon' => 'required',
        ],[
            'name.required' => 'Category name is required',
            'image.required' => 'Category photo is required',
            'icon.required' => 'Category icon is required',
        ]);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $image_filename = $this->getImage($request->file('image'));
        $icon_filename = $this->getIcon($request->file('icon'));
        $category = $this->getCategory($request,$image_filename,$icon_filename);
        Category::create($category);
        return redirect()->route('admin#index')->with(['categorySuccess'=>"Crategory created succcessfully...!"]);
    }

    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.update')->with(['category'=>$category]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],[
            'name.required' => 'Category name is required',
        ]);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->image == '' && $request->icon == ''){
            Category::where('id',$id)->update(['name'=>$request->name,'status'=>$this->getStatus($request->status)]);
        }else if($request->image == ''){
            // dd('image null');
            $icon_filename =  $this->getIcon($request->file('icon'));
            Category::where('id',$id)->update(['name'=>$request->name,'status'=>$this->getStatus($request->status), 'icon'=>$icon_filename]);
        }else if($request->icon == ''){
            // dd('icon null');
            $image_filename =  $this->getImage($request->file('image'));
            Category::where('id',$id)->update(['name'=>$request->name,'status'=>$this->getStatus($request->status), 'image'=>$image_filename]);
        }else{
            $image_filename = $this->getImage($request->file('image'));
            $icon_filename = $this->getIcon($request->file('icon'));
            $category = $this->getCategory($request,$image_filename,$icon_filename);
            Category::where('id',$id)->update($category);
        } 
        return redirect()->route('admin#index')->with(['updateSuccess'=>"Crategory updated successfully...!"]);
    }

    public function destroy($id)
    {
        $data = Category::where('id',$id)->first();
        $image_filename = $data['image'];
        $icon_filename = $data['icon'];
        if (File::exists(public_path().'/uploads/category/img/'.$image_filename))
            File::delete(public_path().'/uploads/category/img/'.$image_filename); 
        if (File::exists(public_path().'/uploads/category/icon/'.$icon_filename))
            File::delete(public_path().'/uploads/category/icon/'.$icon_filename);
        Category::where('id',$id)->delete();
        return redirect()->route('admin#index')->with(['deleteSuccess'=>'Category deleted!']);   
    }

    public function publish($id){
        $data = Category::where('id',$id)->first();
        if($data->status == '1'){
            Category::where('id',$id)->update(['status'=>'0']);
        }else{
            Category::where('id',$id)->update(['status'=>'1']);
        }  
        return redirect()->route('admin#index');
    }

    private function getImage($category_image){
        $filename = uniqid().'_'.$category_image->getClientOriginalName();
        $category_image->move(public_path().'/uploads/category/img', $filename);
        return $filename;
    }

    private function getIcon($category_icon){
        $filename = uniqid().'_'.$category_icon->getClientOriginalName();
        $category_icon->move(public_path().'/uploads/category/icon', $filename);
        return $filename;
    }
    // get request category data
    private function getCategory($request, $image_filename, $icon_filename){
        return [
            'name' => $request->name,
            'image' => $image_filename,
            'icon' => $icon_filename,
            'status' => $this->getStatus($request->status),
        ];
    }

    // get status (is publish?)
    private function getStatus($status){
        return $status == 'on';
    }
}
