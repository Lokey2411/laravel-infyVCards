<html lang="en">

<head>
    <link>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>vcard</title>

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard1.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">

    {{-- font-awesome --}}
    <link href="{{ asset('backend/css/all.min.css') }}" rel="stylesheet">

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <div class="container h-100">
        <div
            class="vcard-one main-content w-100 h-100 mx-auto
    @if ($blog->vcard->template_id == 1) vcard-one-bg
    @elseif($blog->vcard->template_id == 2)
            vcard-two-bg
    @elseif($blog->vcard->template_id == 3)
            vcard-three-bg
    @elseif($blog->vcard->template_id == 4)
            vcard-four-bg
    @elseif($blog->vcard->template_id == 5)
            vcard-five-bg
    @elseif($blog->vcard->template_id == 6)
            vcard-six-bg
    @elseif($blog->vcard->template_id == 7)
            vcard-seven-bg
    @elseif($blog->vcard->template_id == 8)
            vcard-eight-bg
    @elseif($blog->vcard->template_id == 9)
            vcard-nine-bg
    @elseif($blog->vcard->template_id == 10)
            vcard-ten-bg
    @elseif($blog->vcard->template_id == 13)
           vcard-thirteen-bg
    @elseif($blog->vcard->template_id == 14)
           vcard-fourteen-bg
    @elseif($blog->vcard->template_id == 12)
            vcard-twelve-bg
    @elseif($blog->vcard->template_id == 15)
            vcard-fifteen-bg
    @elseif($blog->vcard->template_id == 16)
            vcard-sixteen-bg
    @elseif($blog->vcard->template_id == 17)
            vcard-seventeen-bg
    @elseif($blog->vcard->template_id == 21)
            vcard-twentyone-bg
    @elseif($blog->vcard->template_id == 22)
            vcard-twentytwo-bg h-auto
    @elseif($blog->vcard->template_id == 20)
            vcard-twenty-bg
    @elseif($blog->vcard->template_id == 18)
    vcard-eighteen-bg
    @elseif($blog->vcard->template_id == 19)
            vcard-nineteen-bg
    @elseif($blog->vcard->template_id == 23)
            vcard-twentythree-bg h-auto
    @elseif($blog->vcard->template_id == 24)
            vcard-twentyfour-bg h-auto @endif">
            <div class="vcard-one-main-section p-3">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2
                        class="blog-title
             @if ($blog->vcard->template_id == 1) vcard-one-title
            @elseif($blog->vcard->template_id == 2)
                        vcard-two-title
@elseif($blog->vcard->template_id == 3)
                        vcard-three-title
@elseif($blog->vcard->template_id == 4)
                        vcard-four-title
@elseif($blog->vcard->template_id == 5)
                        vcard-five-title
@elseif($blog->vcard->template_id == 6)
                        vcard-six-title
@elseif($blog->vcard->template_id == 7)
                        vcard-seven-title
@elseif($blog->vcard->template_id == 8)
                        vcard-eight-title
@elseif($blog->vcard->template_id == 9)
                        vcard-nine-title
@elseif($blog->vcard->template_id == 10)
                        vcard-ten-title
@elseif($blog->vcard->template_id == 13)
                   vcard-thirteen-title
@elseif($blog->vcard->template_id == 14)
                   vcard-fourteen-title
@elseif($blog->vcard->template_id == 12)
                    vcard-twelve-title
@elseif($blog->vcard->template_id == 15)
                        vcard-fifteen-title
@elseif($blog->vcard->template_id == 17)
                vcard-seventeen-title text-dark
@elseif($blog->vcard->template_id == 16)
                        vcard-sixteen-title
@elseif($blog->vcard->template_id == 21)
                        vcard-twentyone-title
@elseif($blog->vcard->template_id == 24)
                        vcard-twentyfour-title
@elseif($blog->vcard->template_id == 22)
                        vcard-twentytwo-title
@elseif($blog->vcard->template_id == 20)
vcard-twenty-title
@elseif($blog->vcard->template_id == 18)
                        vcard-eighteen-title
@elseif($blog->vcard->template_id == 19)
                        vcard-nineteen-title
@elseif($blog->vcard->template_id == 23)
                        vcard-twentythree-title @endif">
                        {{ $blog->title }}</h2>
                    <div class="blog-hover-btn">
                        <a class="btn
                    @if ($blog->vcard->template_id == 1) vcard-one-back
                    @elseif($blog->vcard->template_id == 2)
                            vcard-two-back
                    @elseif($blog->vcard->template_id == 3)
                            vcard-three-back
                    @elseif($blog->vcard->template_id == 4)
                            vcard-four-back
                    @elseif($blog->vcard->template_id == 5)
                            vcard-five-back
                    @elseif($blog->vcard->template_id == 6)
                            vcard-six-back
                    @elseif($blog->vcard->template_id == 7)
                            vcard-seven-back
                    @elseif($blog->vcard->template_id == 8)
                            vcard-eight-back
                    @elseif($blog->vcard->template_id == 9)
                            vcard-nine-back
                    @elseif($blog->vcard->template_id == 10)
                            vcard-ten-back
                    @elseif($blog->vcard->template_id == 13)
                            vcard-thirteen-back
                    @elseif($blog->vcard->template_id == 14)
                            vcard-fourteen-back
                    @elseif($blog->vcard->template_id == 12)
                            vcard-twelve-back
                    @elseif($blog->vcard->template_id == 15)
                            vcard-fifteen-back
                    @elseif($blog->vcard->template_id == 17)
                            vcard-seventeen-back
                    @elseif($blog->vcard->template_id == 16)
                            vcard-sixteen-back
                    @elseif($blog->vcard->template_id == 21)
                            vcard-twentyone-back
                    @elseif($blog->vcard->template_id == 24)
                            vcard-twentyfour-back
                    @elseif($blog->vcard->template_id == 22)
                            vcard-twentytwo-back
                    @elseif($blog->vcard->template_id == 20)
                            vcard-twenty-back
                    @elseif($blog->vcard->template_id == 18)
                            vcard-eighteen-back
                    @elseif($blog->vcard->template_id == 19)
                            vcard-nineteen-back
                    @elseif($blog->vcard->template_id == 23)
                            vcard-twentythree-back @endif"
                            href="{{ url()->previous() }}" role="button">
                            {{ __('messages.common.back') }}
                        </a>
                    </div>
                </div>

                <div
                    class="img-bx
            @if ($blog->vcard->template_id == 1) vcard-one-img-bx
            @elseif($blog->vcard->template_id == 2)
                    vcard-two-img-bx
            @elseif($blog->vcard->template_id == 3)
                    vcard-three-img-bx
            @elseif($blog->vcard->template_id == 4)
                    vcard-four-img-bx
            @elseif($blog->vcard->template_id == 5)
                    vcard-five-img-bx
            @elseif($blog->vcard->template_id == 6)
                    vcard-six-img-bx
            @elseif($blog->vcard->template_id == 7)
                    vcard-seven-img-bx
            @elseif($blog->vcard->template_id == 8)
                    vcard-eight-img-bx
            @elseif($blog->vcard->template_id == 9)
                    vcard-nine-img-bx
            @elseif($blog->vcard->template_id == 10)
                    vcard-ten-img-bx
            @elseif($blog->vcard->template_id == 13)
                    vcard-thirteen-img-bx
            @elseif($blog->vcard->template_id == 14)
                    vcard-fourteen-img-bx
            @elseif($blog->vcard->template_id == 12)
                    vcard-twelve-img-bx
            @elseif($blog->vcard->template_id == 13)
                    vcard-thirteen-img-bx
            @elseif($blog->vcard->template_id == 15)
                    vcard-fifteen-img-bx
            @elseif($blog->vcard->template_id == 17)
                    vcard-seventeen-img-bx
            @elseif($blog->vcard->template_id == 16)
                     vcard-sixteen-img-bx
            @elseif($blog->vcard->template_id == 21)
                     vcard-twentyone-img-bx
            @elseif($blog->vcard->template_id == 24)
                     vcard-twentyfour-img-bx
            @elseif($blog->vcard->template_id == 22)
                     vcard-twentytwo-img-bx
            @elseif($blog->vcard->template_id == 18)
                     vcard-eighteen-img-bx
            @elseif($blog->vcard->template_id == 19)
                     vcard-nineteen-img-bx
            @elseif($blog->vcard->template_id == 20)
                    vcard-twenty-img-bx
            @elseif($blog->vcard->template_id == 23)
                    vcard-twentythree-img-bx @endif">
                    <img src="{{ $blog->blog_icon }}" />
                </div>
                <div class="details mt-4">
                    <p class="fw-light">{!! $blog->description !!}</p>
                    <div class="blog-hover-btn-mobile fw-light">
                        <a class="btn float-end
                    @if ($blog->vcard->template_id == 1) vcard-one-back
                    @elseif($blog->vcard->template_id == 2)
                            vcard-two-back
                    @elseif($blog->vcard->template_id == 3)
                            vcard-three-back
                    @elseif($blog->vcard->template_id == 4)
                            vcard-four-back
                    @elseif($blog->vcard->template_id == 5)
                            vcard-five-back
                    @elseif($blog->vcard->template_id == 6)
                            vcard-six-back
                    @elseif($blog->vcard->template_id == 7)
                            vcard-seven-back
                    @elseif($blog->vcard->template_id == 8)
                            vcard-eight-back
                    @elseif($blog->vcard->template_id == 9)
                            vcard-nine-back
                    @elseif($blog->vcard->template_id == 10)
                            vcard-ten-back
                    @elseif($blog->vcard->template_id == 13)
                            vcard-thirteen-back
                    @elseif($blog->vcard->template_id == 14)
                            vcard-fourteen-back
                    @elseif($blog->vcard->template_id == 12)
                            vcard-twelve-back
                    @elseif($blog->vcard->template_id == 15)
                            vcard-fifteen-back
                    @elseif($blog->vcard->template_id == 17)
                            vcard-seventeen-back
                    @elseif($blog->vcard->template_id == 16)
                            vcard-sixteen-back
                    @elseif($blog->vcard->template_id == 21)
                            vcard-twentyone-back
                    @elseif($blog->vcard->template_id == 24)
                            vcard-twentyfour-back
                    @elseif($blog->vcard->template_id == 22)
                            vcard-twentytwo-back
                    @elseif($blog->vcard->template_id == 20)
                            vcard-twenty-back
                    @elseif($blog->vcard->template_id == 18)
                            vcard-eighteen-back
                    @elseif($blog->vcard->template_id == 19)
                            vcard-nineteen-back
                    @elseif($blog->vcard->template_id == 23)
                            vcard-twentythree-back @endif"
                            href="{{ url()->previous() }}" role="button">
                            {{ __('messages.common.back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var primaryColor = @json($dynamicVcard->primary_color ?? null);
            var backColor = @json($dynamicVcard->back_color ?? null);
            var backSecondColor = @json($dynamicVcard->back_seconds_color ?? null);
            var buttonTextColor = @json($dynamicVcard->button_text_color ?? null);
            var textDescriptionColor = @json($dynamicVcard->text_label_color ?? null);
            var textLabelColor = @json($dynamicVcard->text_description_color ?? null);

            document.documentElement.style.setProperty('--primary-color', primaryColor);
            document.documentElement.style.setProperty('--green-100', backColor);
            document.documentElement.style.setProperty('--green', backSecondColor);
            document.documentElement.style.setProperty('--black', buttonTextColor);
            document.documentElement.style.setProperty('--gray-100', textDescriptionColor);
            document.documentElement.style.setProperty('--white', textLabelColor);
        });
    </script>
</body>

</html>
