@extends('vcardTemplates.vcard11.app')
@section('title')
{{__('auth.home')}}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_name')
    {{__('auth.about')}}
@endsection
@section('content')
    <div class="tab-content p-sm-4 p-3" id="v-pills-tabContent">
        <div class="home-tab tab-pane fade show active" id="v-pills-home" role="tabpanel"
             aria-labelledby="v-pills-home-tab">
            <div class="hero-about">
                <div class="row">
                    <div class=" col-xl-6">
                        <p class="text-white  mb-1">{{ $vcard->occupation }}</p>
                        <p class="text-white  mb-1">{{ $vcard->job_title }}</p>
                        <p class="small-title text-white">{{ ucwords($vcard->company) }}</p>
                        <h2 class="text-white fs-34 fw-5 mb-4 d-inline-block">
                            {{ strtoupper($vcard->first_name.' '.$vcard->last_name) }}
                            @if ($vcard->is_verified)
                            <i class="verification-icon bi-patch-check-fill"></i>
                            @endif
                        </h2>
                        <p class="text-white fs-20 mb-2">{{__('messages.common.description')}}</p>
                        <div class="text-white profile-description fs-14 mb-3 fw-normal ">
                          <p class="profile-description"> {!! $vcard->description !!}</p>
                        </div>
                    </div>
                    @if ((isset($managesection) && $managesection['contact_list']) || empty($managesection))
                        @if(isset($vcard->first_name))
                            <div class="col-xl-6 ps-3">
                                <div class="desc">
                                    <div class=" d-flex mb-2 ">
                                        <div class="icon me-4">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div class="">
                                            <span>{{__('messages.common.name')}} :</span>
                                            <a class="ps-2 fs-14">{{ strtoupper($vcard->first_name.' '.$vcard->last_name) }}</a>
                                        </div>
                                    </div>
                                    @if($vcard->location)
                                        <div class=" d-flex mb-2">
                                            <div class="icon me-4">
                                                <i class="fa-sharp fa-solid fa-location-dot"></i>
                                            </div>
                                            <div class="">
                                                <span>{{__('messages.user.location')}} :</span>
                                                <a class="ps-2 fs-14">{!! ucwords($vcard->location) !!}</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($vcard->dob)
                                        <div class=" d-flex mb-2">
                                            <div class="icon me-4">
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="">
                                                <span>{{__('messages.vcard.dob')}} :</span>
                                                <a class="ps-2 fs-14">{{ $vcard->dob }}</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($vcard->phone || $vcard->alternative_phone)
                                        <div class=" d-flex mb-2">
                                            <div class="icon me-4">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="d-flex ">
                                                <span>{{__('auth.contact')}}&nbsp:</span>
                                                <div class="d-flex flex-wrap">
                                                    @if($vcard->phone)
                                                        <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                                        class="ps-2 fs-14">+ {{ $vcard->region_code }}
                                                            {{ $vcard->phone }}</a>
                                                    @endif
                                                    @if($vcard->alternative_phone)
                                                        <a href="tel:+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}"
                                                        class="ps-2 fs-14">+ {{ $vcard->alternative_region_code }}
                                                            {{ $vcard->alternative_phone }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{--                            <a href="{{ route('vcard.show.portfolio',$vcard->url_alias) }}"--}}
                                    {{--                               class="btn btn-primary fs-14 mt-3">MY PORTFOLIO<i--}}
                                    {{--                                        class="fa-solid fa-arrow-right text-white ms-3"></i></a>--}}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                {{--                <div class="row">--}}
                {{--                    <div class="col-sm-4 col-6 text-white text-center py-4">--}}
                {{--                        <h2 class="fs-1 fw-6">--}}
                {{--                            <span class="counter" data-countto="145" data-duration="3000">0</span>--}}
                {{--                        </h2>--}}
                {{--                        <h3 class="fs-6 mb-0 mt-3">FINISHED PROJECTS</h3>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-4 col-6 text-white text-center py-4">--}}
                {{--                        <h2 class="fs-1 fw-6">--}}
                {{--                            <span class="counter" data-countto="825" data-duration="3000">0</span>--}}
                {{--                        </h2>--}}
                {{--                        <h3 class="fs-6 mb-0 mt-3">WORKING HOURS</h3>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-4 col-6 text-white text-center py-4">--}}
                {{--                        <h2 class="fs-1 fw-6">--}}
                {{--                            <span class="counter" data-countto="15" data-duration="3000">0</span>--}}
                {{--                        </h2>--}}
                {{--                        <h3 class="fs-6 mb-0 mt-3">AWARDS WON</h3>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <!-- start services section -->
            @if ((isset($managesection) && $managesection['services']) || empty($managesection))
            @if(checkFeature('services') && $vcard->services->count())
                <section class="services-section pt-30 mt-5">
                    <div class="section-heading mb-40">
                        <h2 class="fs-22 text-white ps-4">{{__('messages.services')}}</h2>
                    </div>
                    <?php $serviceCount = 1 ?>
                    <div class="row">
                        @foreach($vcard->services as $service)
                            <div class="col-md-6 mb-sm-5 mb-4">
                                <div class="card flex-sm-row p-sm-4 p-3 h-100">
                                    <div class="tag d-flex justify-content-center align-items-center">
                                        <span class="fs-6 text-white">{{ $serviceCount++ }}</span>
                                    </div>
                                    <div class="card-img-top">
                                        <img src="{{ $service->service_icon }}" height="70" width="70"
                                             class="object-fit-cover  custom-border-radius">
                                    </div>
                                    <div class="card-body p-0 ps-sm-4 pt-sm-0 pt-3">
                                        <a class="text-decoration-none text-white"
                                           href="{{ $service->service_url ?? '#' }}" target="_blank">
                                            <h5 class="card-title fs-18">{{ $service->name }}</h5>
                                            {{--                                        @php--}}
                                            {{--                                            $service->description = strlen($service->description) > 200 ? substr($service->description,0,200).'..                                                         .':$service->description--}}

                                            {{--                                        @endphp--}}
                                            <p class="card-text fs-14  mb-0 {{ \Illuminate\Support\Str::length($service->description) > 80 ? 'more' : ''}}">
                                                {!! $service->description !!}
                                            </p>
                                        </a>
                                        {{--                                        <div class="d-flex flex-wrap pt-3">--}}
                                        {{--                                            <span class="fs-12 text-white me-3">CODE</span>--}}
                                        {{--                                            <span class="fs-12 text-white me-3">DESIGN</span>--}}
                                        {{--                                            <span class="fs-12 text-white ">PHOTOSHOP</span>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </section>
            @endif
            @endif
        <!-- start product section -->
            @if(checkFeature('products') && $vcard->products->count())
                @if ((isset($managesection) && $managesection['products']) || empty($managesection))
                    <section class="services-section pt-30">
                        <div class="section-heading mb-5">
                            <h2 class="fs-22 text-white ps-4">{{__('messages.feature.products')}}</h2>
                            <div class="text-end ">
                                <a class="fs-6 ps-4 text-decoration-underline text-light" href="{{ route('showProducts',['id'=>$vcard->id,'alias'=>$vcard->url_alias]) }}">{{__('messages.analytics.view_more')}}</a>
                                </div>
                        </div>
                        <?php $ProductCount = 1 ?>
                        <div class="row">
                            @foreach($vcardProducts  as $product)
                                <div class="col-md-6 mb-sm-5 mb-4">
                                    <a @if($product->product_url) href="{{ $product->product_url }}" @endif>
                                        <div class="card flex-sm-row p-sm-4 p-3 h-100">
                                            <div class="tag d-flex justify-content-center align-items-center">
                                                <span class="fs-6 text-white">{{ $ProductCount++ }}</span>
                                            </div>
                                            <div class="card-img-top">
                                                <a @if($product->product_url) href="{{ $product->product_url }}"
                                                target="_blank" @endif>
                                                    <div class="card-img-top">
                                                        <img src="{{ $product->product_icon }}"
                                                            class="w-100 h-100 object-fit-cover custom-border-radius">
                                                    </div>
                                            </div>
                                            <div class="card-body p-0 ps-sm-4 pt-sm-0 pt-3">
                                                <div class="d-flex justify-content-between">
                                                <h5 class="card-title fs-18">{{ $product->name }}</h5>
                                                    </div>
                                                @if($product->currency_id && $product->price)
                                                    <p class=" fs-14 pb-4 mb-0">
                                                        {{$product->currency->currency_icon}}{{number_format($product->price ,2)}}
                                                    </p>
                                                @elseif($product->price)
                                                    <p class=" fs-14 pb-4 mb-0">{{ getUserCurrencyIcon($vcard->user->id) .' '. $product->price }}</p>
                                                @endif
                                            <div class="pb-3">
                                                <p class="card-text fs-14 pb-4 mb-0">
                                                    {!! $product->description !!}
                                                </p>
                                            </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </section>
                @endif
            @endif

        <!-- end services section -->

            <!-- start testimonials-section -->
            {{--testimonial--}}
            @if ((isset($managesection) && $managesection['testimonials']) || empty($managesection))
                @if(checkFeature('testimonials') && $vcard->testimonials->count())
                    <section class="testimonials-section position-relative mt-4 ">
                        @php $testimonialCount = 1;
                    $style = 'style';
                    $marginBottom = 'margin-bottom';
                        @endphp
                        <div class="section-heading ">
                            <h2 class="fs-22 text-white ps-4 " {{$style}}="{{$marginBottom}}: -10px;"
                            >{{__('messages.feature.testimonials')}}</h2>
                        </div>
                        <div class="slick-slider">
                            @foreach($vcard->testimonials as $testimonial)
                                <div class="col element element-1 @if($vcard->testimonials->count()==1) custom-margin-testimonial @endif h-100 m-0 mt-3 ">
                                    <a class="fs-14 ps-3"></a>
                                    <div class="card testimonial-2card-custom  mb-3 me-4 flex-sm-row p-4 h-100">
                                        <div class="tag d-flex justify-content-center align-items-center">
                                            <span class="fs-6 text-white">{{ $testimonialCount++ }}</span>
                                        </div>
                                        <div class="card-img-top">
                                            <img src="{{ $testimonial->image_url }}"
                                                class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div class="card-body p-0 ps-sm-4 pt-sm-0 pt-3">
                                            <h5 class="card-title fs-18">{{ucwords( $testimonial->name) }}</h5>
                                            <p class="card-text fs-14 {{ \Illuminate\Support\Str::length($testimonial->description) > 80 ? 'more' : ''}} mb-0">
                                                "{!! $testimonial->description !!} "
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endif
        <!-- end testimonials-section -->
        <!--insta feed-->
        @if ((isset($managesection) && $managesection['insta_embed']) || empty($managesection))
        @if (checkFeature('instagramEmbed') && $vcard->instagramEmbed->count())
        <div class="section-heading mb-5">
            @php $testimonialCount = 1;
            $style = 'style';
            $marginBottom = 'margin-bottom';
            @endphp
            <h2 class="fs-22 text-white ps-4" {{$style}}="{{$marginBottom}}: -10px;"
            >{{__('messages.feature.insta_embed')}}</h2>
        </div>
        <nav>
            <div class="row insta-toggle">
            <div class="nav nav-tabs px-0 border-0" id="nav-tab" role="tablist">
                <button class="py-2 border-0 active postbtn instagram-btn text-center" id="nav-home-tab"
                    data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    <span class="text-center">{{ __('messages.vcard.post') }}</span></button>
                <button class="py-2 border-0 instagram-btn reelsbtn text-center" id="nav-profile-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                    aria-selected="false">
                    <span class="text-center">{{ __('messages.vcard.reel') }}</span>
                </button>
            </div>
            </div>
        </nav>
                <div id="postContent">
                    <div class="row overflow-hidden m-0 mt-5">
                        <!-- "Post" content -->
                        @foreach ($vcard->InstagramEmbed as $InstagramEmbed)
                            @if ($InstagramEmbed->type == 0)
                                <div class="col-12 col-sm-6 instagramEmbed">
                                    {!! $InstagramEmbed->embedtag !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="reelContent">
                    <div class="row overflow-hidden  mt-5">
                        <!-- "Reel" content -->
                        @foreach ($vcard->InstagramEmbed as $InstagramEmbed)
                            @if ($InstagramEmbed->type == 1)
                                <div class="col-12 col-sm-6 mt-2 instagramEmbed">
                                    {!! $InstagramEmbed->embedtag !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
        </div>
        @endif
        @endif
          <!--insta feed end-->
        @if ((isset($managesection) && $managesection['iframe']) || empty($managesection))
        @if (checkFeature('iframes') && $vcard->iframes->count())
        <div class="vcard-one__blog">
            <div class="section-heading">
                <h2 class="fs-22 text-white ps-4 mt-5">{{__('messages.vcard.iframe')}}</h2>
            </div>
            <div class="container iframe-section">
                <div class="iframe-slider">
                    @foreach ($vcard->iframes as $iframe)
                        <div class="col-12 mb-2 col">
                            <div class="card p-sm-2 border-0 w-70 d-flex align-items-center m-3">
                                <iframe src="{{ $iframe->url }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen width="100%" height="300">
                                </iframe>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @endif
            <!-- start client-section -->
            @if ((isset($managesection) && $managesection['galleries']) || empty($managesection))
                @if(checkFeature('gallery') && $vcard->gallery->count())
                    <section class="client-section">
                        <div class="section-heading mb-4">
                            <h2 class="fs-22 text-white ps-4 mt-5">{{__('messages.feature.gallery')}}</h2>
                        </div>
                        <div class="row">
                            @foreach($vcard->gallery as $file)
                                @php
                                    $infoPath = pathinfo(public_path($file->gallery_image));
                                $extension = $infoPath['extension'];
                                @endphp
                                <div class="col-md-3 col-6  mt-3">
                                    <div class="client-box w-100 h-100 ">
                                        <div class="client-img">
                                            @if($file->type == App\Models\Gallery::TYPE_IMAGE)
                                                <a href="{{$file->gallery_image}}" data-lightbox="gallery-images"><img src="{{ $file->gallery_image }}"
                                                                                                                    class="w-100 h-100 object-fit-cover rounded"></a>
                                            @elseif($file->type == App\Models\Gallery::TYPE_FILE)
                                                <a id="file_url" href="{{$file->gallery_image}}"
                                                class="gallery-link gallery-file-link" target="_blank">
                                                    @if($extension=='pdf')
                                                        <img src="{{ asset('assets/images/pdf-icon.png') }}"
                                                            class="w-100 h-100 object-fit-cover rounded">
                                                    @endif
                                                    @if($extension=='xls')
                                                        <img src="{{ asset('assets/images/xls.png') }}"
                                                            class="w-100 h-100 object-fit-cover rounded">
                                                    @endif
                                                    @if($extension=='csv')
                                                        <img src="{{ asset('assets/images/csv-file.png') }}"
                                                            class="w-100 h-100 object-fit-cover rounded">
                                                    @endif
                                                    @if($extension=='xlsx')
                                                        <img src="{{ asset('assets/images/xlsx.png') }}"
                                                            class="w-100 h-100 object-fit-cover rounded">
                                                    @endif
                                                </a>
                                            @elseif($file->type == App\Models\Gallery::TYPE_VIDEO)
                                            <div class="video-container d-flex align-items-center">
                                                <video width="100%" controls>
                                                    <source src="{{ $file->gallery_image }}">
                                                </video>
                                            </div>
                                            @elseif($file->type == App\Models\Gallery::TYPE_AUDIO)
                                                <div class="audio-container">
                                                    <img src="{{ asset('assets/img/music.jpeg') }}" alt="Album Cover" class="audio-image" height="170">
                                                    <audio controls src="{{ $file->gallery_image }}" class="mt-2">
                                                        Your browser does not support the <code>audio</code> element.
                                                    </audio>
                                                </div>
                                            @else
                                                <iframe src="https://www.youtube.com/embed/{{ YoutubeID($file->link) }}"
                                                    class="w-100 h-100 object-fit-cover">
                                                </iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                @endif
            @endif
            <div class="d-flex justify-content-center mt-5 text-white">
                @if(checkFeature('advanced'))
                    @if(checkFeature('advanced')->hide_branding && $vcard->branding == 0)
                        @if($vcard->made_by)
                            <a @if(!is_null($vcard->made_by_url)) href="{{$vcard->made_by_url}}"
                               @endif class="text-center text-decoration-none text-white" target="_blank">
                                <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small></a>
                        @endif
                    @else
                        <div class="text-center">
                            <small>{{ __('messages.made_by') }} {{ $setting['app_name'] }}</small>
                        </div>
                    @endif
                @endif
            </div>
               <!-- Modal -->
               @if ((isset($managesection) && $managesection['news_latter_popup']) || empty($managesection))
                    <div class="modal fade" id="newsLatterModal" tabindex="-1" aria-labelledby="newsLatterModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog news-modal">
                            <div class="modal-content animate-bottom" id="newsLatter-content">
                                <div class="newsmodal-header">
                                    <button type="button" class="btn-close p-5 position-absolute top-0 end-0" data-bs-dismiss="modal"
                                    aria-label="Close" id="closeNewsLatterModal"></button>
                                    <h1 class="newsmodal-title text-center mt-5" id="newsLatterModalLabel"><i class="fa-solid fa-envelope-open-text"></i></h1>
                                </div>
                                <div class="modal-body">
                                    <h1 class="content text-center  p-2">{{ __('messages.vcard.subscribe_newslatter') }}</h1>
                                    <h3 class="modal-desc text-center">{{ __('messages.vcard.update_directly') }}</h3>
                                    <div class="input-group mb-3 mt-5">
                                        <input type="email" class="form-control" placeholder="{{ __('messages.form.enter_your_email') }}" aria-label="Email" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="button" id="email-send"><i class="fa-regular fa-envelope"></i></button>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
@endsection
<script>
    listenClick('.postbtn', function () {
    $('#postContent').addClass('d-block');
    $('#postContent').removeClass('d-none');
    $('#reelContent').addClass('d-none');
    $('#reelContent').removeClass('d-block');
});
listenClick('.reelsbtn', function () {
    $('#postContent').addClass('d-none');
    $('#postContent').removeClass('d-block');
    $('#reelContent').removeClass('d-none');
    $('#reelContent').addClass('d-block');
});
</script>
