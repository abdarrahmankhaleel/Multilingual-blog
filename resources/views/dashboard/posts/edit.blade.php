{{-- {{ dd($post) }} --}}
@extends('dashboard.layouts.layout')

@section('body')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{ __('words.users') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ __('words.add user') }}</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;{{ __('words.users') }}</a>
                <a class="btn btn-secondary" href="#"><i class="icon-posts"></i> &nbsp;{{ __('words.add user') }}</a>
            </div>
        </li>
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{ route('dashboard.posts.update'  , $post) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ __('words.users') }}</strong>
                        </div>
                        <div class="card-block">
                            <div class="form-group col-md-6">
                                <label>{{ __('words.image') }}</label>
                                <img src="{{asset($post->image)}}" alt="" style="height: 50px">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.image') }}</label>
                                <input type="file" name="image" class="form-control" placeholder="Enter Email..">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.category_id') }}</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">???????? ?????? ??????????????</option>
                                    @foreach ($categories as $category)
                                    <option {{ ($post->category_id== $category->id)?'selected':'' }} value="{{ $category->id }}" >{{ $category->title }}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.translations') }}</strong>
                            </div>
                            <div class="card-block">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    @foreach (config('app.languages') as $key => $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->index == 0) active @endif"
                                                id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                                aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                            id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                            <br>
                                            <div class="form-group mt-3 col-md-12">
                                                <label>{{ __('words.title') }} - {{ $lang }}</label>
                                                <input type="text" name="{{$key}}[title]" class="form-control"
                                                  value="{{ $post->translate($key)->title}}"  placeholder="{{ __('words.title') }}">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.smallDesc') }}</label>
                                                <textarea name="{{$key}}[smallDesc]" class="form-control" id="editor" cols="30" rows="10">
                                                     {{ $post->translate($key)->smallDesc}}
                                                </textarea>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.content') }}</label>
                                                <textarea name="{{$key}}[content]" class="form-control" id="editor" cols="30" rows="10">
                                                    
                                                    {{$post->translate($key)->content}}
                                                </textarea>
                                            </div>
                                            

                                            <div class="form-group mt-3 col-md-12">
                                                <label>{{ __('words.tags') }} - {{ $lang }}</label>
                                                <input type="text" name="{{$key}}[tags]" class="form-control"
                                                 value="{{$post->translate($key)->tags }}" ,  placeholder="{{ __('words.tags') }}">
                                            </div>
                                        </div>
                                    @endforeach

                                </div>



                            </div>


                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                    Submit</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                    Reset</button>
                            </div>

                        </div>




                    </div>
            </form>
        </div>
    </div>
@endsection