{{-- @php                          
$cate=$cat::where('id',$post->category_id)->first() 
@endphp

{{ dd($post->category_id,$cate) }}

{{ die }} --}}
{{-- {{ dd($category) }} --}}
@extends('web.layout.layout')
@section('title')
{{$post->title}} - {{$setting->title}}
@endsection
@section('mata_description')
        {!! $post->smallDesc !!}
@endsection
@section('mata_keywords')
        الكلمات الدلالية
@endsection
@extends('web.layout.layout')
<div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="img/news-500x280-2.jpg" style="object-fit: cover;">
                        <div class="overlay position-relative bg-light">
                            <div class="mb-3">
                                <a href="{{ route('category',$post->category_id) }}">@if ($post->category!=null)
                                    {{ $post->category->title }}
                                @else
                                @php
                                    
                                     $cate=$cat::where('id',$post->category_id)->first() 
                                @endphp
                                    {{ $cate->title }}
                                @endif</a>
                                <span class="px-1">/</span>
                                <span>{{ $post->created_at->format('M d,y') }}</span>
                            </div>
                            <div>
                                <h3>{{ $post->title }}</h3>
                                <p class="m-0">{!! $post->smallDesc !!}</p>
                                <p class="m-0">{!! $post->content !!}</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>