<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Trit\UploadingImg;
use App\Models\Setting;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
   
    protected  $setting;
    public function __construct(Setting $setting)
    {
    $this->setting=$setting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('view',$this->setting);

        $parentCategories=Category::whereNull('parent')->orWhere('parent',0)->get();
        // dd($parentCategories);
        return view('dashboard.category.add',compact('parentCategories'));
    }
    public function getcategoryDatatable()
    {
        $data = Category::select('*')->with('getparent');

    return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
              if(auth()->user()->can('view',$this->setting))  {
                  
                      $btn .= '<a href="' . Route('dashboard.category.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';
                      $btn .= '
                          
                          <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';        
                  return $btn;
              }else{return ;}
            })
            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->addColumn('parent', function ($row) {
                return ($row->parent > 0) ? $row->getparent->translate(app()->getLocale())->title : trans('words.main category');
            })
            ->rawColumns(['action','title'])
            ->make(true);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $this->authorize('view',$this->setting);
        $category=Category::create($request->except('image','_token'));
        if($request->file('image')){
            $file=$request->file('image');
            $filename=Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('imgs'),$filename);
            $path='imgs/'.$filename;
            $category->update(['image'=>$path]);
        }
        foreach(config('app.languages') as $key => $lang){
            CategoryTranslation::where(['category_id'=>$category->id,'locale'=>$key])->update(['slug' => Str::slug($request->$key['title'])]);
        }
        return redirect()->route('dashboard.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function edit(Category $category)
    {
        
        $this->authorize('view',$this->setting);

        $parentCategories=null;
        if(!($category->parent==""||$category->parent==0)){
            $parentCategories=Category::whereNull('parent')->orWhere('parent',0)->get();
        }

        return view('dashboard.category.edit',['category'=>$category,'parentCategories'=>$parentCategories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('view',$this->setting);

        $category->update($request->except('image','_token'));
        if($request->file('image')){
            $file=$request->file('image');
            $filename=Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('imgs'),$filename);
            $path='imgs/'.$filename;
            $category->update(['image'=>$path]);
        }
        return redirect()->route('dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $this->authorize('view',$this->setting);

        if(is_numeric($request->id)){
            Category::where('parent',$request->id)->delete();// delelte children of that $request->id 
            Category::where('id',$request->id)->delete();
        }
        return redirect()->route('dashboard.category.index');
    }
}
