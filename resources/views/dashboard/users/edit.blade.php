{{-- {{ dd($user->toArray()) }} --}}

@extends('dashboard.layouts.layout')

@section('body')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{__('words.dashboard')}}</a>
        </li>
        <li class="breadcrumb-item active">داشبرد</li>

       
    </ol>


    {{-- {{-- {{dd($user)}}   الستنق دي عبارة عن ريكورد داتا بيز لما تبعثها كدا از بريمتر للراوت ببعث رقم الايدي ولما تستقبلها في دالة في الكونستركتور لازم تحط التايب بتاعها الي هو المدول الستنق --}}

    <div class="container-fluid">
    {{--/<form action="{{Route('dashboard.users.update',['user'=>$user])}}" method="post" enctype="multipart/form-data"> --}}

        <div class="animated fadeIn">
            <form action="{{Route('dashboard.users.update' , $user)}}" method="post" enctype="multipart/form-data">
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
                                <label>{{ __('words.name') }}</label>
                                <input  type="text" name="name" class="form-control"
                                    placeholder="{{ __('words.name') }}" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.email') }}</label>
                                <input  type="text" name="email" class="form-control"
                                    placeholder="{{ __('words.email') }}"  value="{{ old('email',$user->email) }}">
                            </div>

                            @can('viewAny',$user)
                                
                            <div class="form-group col-md-6">
                                <label>{{ __('words.status') }}</label>
                                <select  name="status" class="form-control">
                                    <option value='' {{ ($user->status==''?'selected':'') }}>غير مفعل</option>
                                    <option value="admin" {{ ($user->status=='admin'?'selected':'') }}>Admin</option>
                                    <option value="writer" {{ ($user->status=='writer'?'selected':'') }}>Writer</option>
                                </select>
                            </div>
                            @endcan



                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                    Submit</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                    Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 