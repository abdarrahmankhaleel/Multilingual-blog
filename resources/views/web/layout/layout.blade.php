{{-- {{ dd($last5posts) }} --}}
<!DOCTYPE html>
<html lang="en">
{{-- الجزء بتاع الاقسام والهيدر فيه كاتيقوريز منلاحظ انه ثابت فمنا يكون الداتا الي فيه متشيرة لللموقع كامل للصفحات كلها --}}
<head>
    <meta charset="utf-8">
    <title> @yield('title',$setting->translate(app()->getlocale())->title)</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('mata_keywords', $setting->translate(app()->getlocale())->title )" ,name="keywords">
    <meta content="@yield('mata_description', $setting->translate(app()->getlocale())->content )" ,name="description" >

    <!-- Favicon -->
    <link href="{{asset($setting->favicon) }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">   

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-white text-center py-2" style="width: 100px;">Tranding</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                        @foreach ($last5posts as $post)
                        <div class="text-truncate"><a class="text-secondary" href="{{ route('post',$post->id) }}">{{ $post->title }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right d-none d-md-block">
               {{date('D Y,M,d')}}
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <img src="{{asset($setting->logo) }}" alt="" height="70px">
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <img class="img-fluid" src="img/ads-700x70.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <img src="{{asset($setting->logo) }}" alt="" height="70px">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="{{ route('index') }}" class="nav-item nav-link active">{{ __('words.home') }}</a>
                    @foreach ($categories as $category)
                    <div class="nav-item dropdown">
                        <a @if(count($category->children)<1) href="{{ route('category',$category->id) }}"@else href="#" @endif class="nav-link  @if(count($category->children)>0) dropdown-toggle @endif " 
                            @if(count($category->children)>0) data-toggle="dropdown"@endif >{{ $category->title}}</a>

                            @if (count($category->children)>0)
                        <div class="dropdown-menu rounded-0 m-0">
                            @foreach ($category->children as $child )
                          
                            @endforeach
                            <a href="{{ route('category',$child->id) }}" class="dropdown-item">{{ $child->title}}</a>
                        </div>                        

                        
                        
                        @endif
                    </div>
                    @endforeach
                </div>






            </div>
        </nav>
    </div>
    <!-- Navbar End -->


   @yield('body')

    <!-- News With Sidebar Start -->
    {{-- <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Popular</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-2.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-1.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-2.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-3.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-3.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-4.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Latest</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-5.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-5.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-1.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-6.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-2.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="img/news-100x100-3.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 pt-3 pt-lg-0">
                    <!-- Social Follow Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Follow Us</h3>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                                <small class="fab fa-facebook-f mr-2"></small><small>12,345 Fans</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                                <small class="fab fa-twitter mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                                <small class="fab fa-linkedin-in mr-2"></small><small>12,345 Connects</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                                <small class="fab fa-instagram mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                                <small class="fab fa-youtube mr-2"></small><small>12,345 Subscribers</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
                                <small class="fab fa-vimeo-v mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                    </div>
                    <!-- Social Follow End -->

                    <!-- Newsletter Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Newsletter</h3>
                        </div>
                        <div class="bg-light text-center p-4 mb-3">
                            <p>Aliqu justo et labore at eirmod justo sea erat diam dolor diam vero kasd</p>
                            <div class="input-group" style="width: 100%;">
                                <input type="text" class="form-control form-control-lg" placeholder="Your Email">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                            <small>Sit eirmod nonumy kasd eirmod</small>
                        </div>
                    </div>
                    <!-- Newsletter End -->

                    <!-- Ads Start -->
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
                    </div>
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tranding</h3>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-1.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-2.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-3.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-4.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-5.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                    </div>
                    <!-- Popular News End -->

                    <!-- Tags Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tags</h3>
                        </div>
                        <div class="d-flex flex-wrap m-n1">
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Politics</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Corporate</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Sports</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Health</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Education</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Science</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Technology</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Foods</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Entertainment</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Travel</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Lifestyle</a>
                        </div>
                    </div>
                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    </div> --}}
    <!-- News With Sidebar End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="index.html" class="navbar-brand">
                    <img src="{{asset($setting->logo) }}" alt="" height="70px">
                </a>
                <p>                  {{ $setting->translate(app()->getlocale())->title }}
                </p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-secondary text-center mr-2 px-0" style="width: 38px; height: 38px;" href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">{{ __('words.categories') }}</h4>
                <div class="d-flex flex-wrap m-n1">
                    @foreach ($categories as $category)
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">{{  $category->title }}</a>
                    @endforeach

              
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>About</a>
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Advertise</a>
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Privacy & policy</a>
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Terms & conditions</a>
                    <a class="text-secondary" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Contact</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="#">Your Site Name</a>. All Rights Reserved. 
			
			<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
			Designed by <a class="font-weight-bold" href="https://htmlcodex.com">HTML Codex</a>
        </p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('front') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('front') }}/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{ asset('front') }}/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('front') }}/js/main.js"></script>
</body>

</html>