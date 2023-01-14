{{-- @dd($category); --}}
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
                <a class="btn btn-secondary" href="#"><i class="icon-categorys"></i> &nbsp;{{ __('words.add user') }}</a>
            </div>
        </li>
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.category.update',$category) }}" method="post" enctype="multipart/form-data">
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
                                <img src="{{asset($category->image)}}" alt="" style="height: 50px">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.image') }}</label>
                                <input type="file" name="image" class="form-control" placeholder="Enter Email..">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.parent') }}</label>
                                <select name="parent" id="" class="form-control">
                                    <option value="0" {{ (old('parent',$category->parent)==0||old('parent',$category->parent)==null)?'selected':'' }}>ليس له قسم رئيسي</option>
                                    @if (!empty($parentCategories)&& count($parentCategories)>0)
                                    @foreach ($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" {{ (old('parent',$category->parent)==$parentCategory->id)?'selected':'' }} >{{ $parentCategory->title }}</option>
                                    @endforeach
                                    @endif
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
                                                 value="{{ $category->translate($key)->title}}"   placeholder="{{ __('words.title') }}">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.content') }}</label>
                                                <textarea name="{{$key}}[content]" class="form-control" cols="30" rows="10">{{$category->translate($key)->content}}</textarea>
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