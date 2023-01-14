<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\posts;
use App\Models\Post;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Http\Trit\UploadingImg;
class PostsController extends Controller
{

    protected  $postmodel;
    public function __construct(Post $post)
    {
    $this->postmodel=$post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('dashboard.posts.index');
    }
    public function getallposts()
    {
        // if (auth()->user()->can('viewAny', $this->user)) {
        $data = Post::select('*')->with('getCategoryOfPost');
        // }else{
        //     $data = User::where('id' , auth()->user()->id);
        // }
    

    return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                if (auth()->user()->can('update', $row)) {
                    $btn .= '<a href="' . route('dashboard.posts.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';
                 }
                 if (auth()->user()->can('delete', $row)) {
                    $btn .= '
                        
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }
        
                return $btn;
            })
            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
            ->addColumn('category_name', function ($row) {
                return $row->getCategoryOfPost->translate(app()->getLocale())->title;
            })
            ->rawColumns(['action','title','category_name'])
            ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        if(count($categories)>0){
            return view('dashboard.posts.add',compact('categories'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=Post::create($request->except('image','_token'));
        // if ($request->has('image')){
        //     $post->update(['image'=>UploadingImg::UploadImg($request->image)]);
        // }
        $post->update(['user_id'=>auth()->user()->id]);
        if($request->file('image')){
            $file=$request->file('image');
            $filename=Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('imgs'),$filename);
            $path='imgs/'.$filename;
            $post->update(['image'=>$path]);
        }
        return view('dashboard.posts.index');

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
    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        $categories=Category::all();
        return view('dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $this->authorize('update',$post);
        $post->update($request->except('image','_token'));
        $post->update(['user_id'=>auth()->user()->id]);

        if($request->file('image')){
            $file=$request->file('image');
            $filename=Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('imgs'),$filename);
            $path='imgs/'.$filename;
            $post->update(['image'=>$path]);
        }
        // dd($request->all());
        return redirect()->route('dashboard.posts.edit',$post);
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
        if(is_numeric($request->id)){
            $post=Post::where('id',$request->id)->delete();
            $post->update(['user_id'=>auth()->user()->id]);

        }
        return redirect()->route('dashboard.posts.index');
    }
}
