<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="stylesheet" href="{{ asset('assets/email/styles/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="box">

            <img src="{{ asset('assets/email/logo.png') }}" alt="logo" class="logo">
            <div class="content">
                <h1 class="title">{{ $data->title }}</h1>
                <p class="desc">
                    {{ $data->short_description }}
                </p>
                <img src="{{ asset($data->image) }}" alt="test image" style="width: 100%;"
                    class="main-image">
                <p class="tiny-text">
                    {!! substr($data->description,0,500) !!}...
                </p>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <a class="button" href="{{ route('front.currentNews.detail',$data->link) }}">Haberin Devamı</a>
            </div>
            <footer class="footer">
                <div class="social-meadi-icons">
                    @if($social != null && $social->facebook != null)
                    <a href="www.facebook.com/{{ $social->facebook }}">
                        <img src="{{ asset('assets/email/svg/facebook.svg') }}" alt="">
                    </a>
                    @endif
                    @if($social != null && $social->instagram != null)
                    <a href="www.instagram.com/{{ $social->instagram }}">
                        <img src="{{ asset('assets/email/svg/instagram.svg') }}" alt="">
                    </a>
                    @endif
                    @if($social != null && $social->twitter != null)
                    <a href="www.twitter.com/{{ $social->twitter }}">
                        <img src="{{ asset('assets/email/svg/x.svg') }}" alt="">
                    </a>
                    @endif
                    @if($social != null && $social->youtube != null)
                    <a href="www.youtube.com/channel/{{ $social->youtube }}">
                        <img src="{{ asset('assets/email/svg/youtube.svg') }}" alt="">
                    </a>
                    @endif
                    @if($social != null && $social->linkedin != null)
                    <a href="www.linkedin.com/company/{{ $social->linkedin }}">
                        <img src="{{ asset('assets/email/svg/linkedin.svg') }}" alt="">
                    </a>
                    @endif
                </div>
                <p class="footer-text">
                    Bu e-postayı, <a href="www.millimudafaa.com" style="font-weight: 700; color: #3e3e3f;"
                        class="link">MilliMudafaa.com'a</a> bu
                    e-posta adresiyle
                    kaydolduğunuz
                    için alıyorsunuz. <strong>Milli Müdafaa</strong>
                    pazarlama e-postalarını almayı durdurmak için <a href="#"
                        style="text-decoration: underline; color: #3e3e3f;">buradan</a>
                    aboneliğinizi iptal edin.
                </p>
                <p class="footer-text-eng">
                    You are receiving this email because you have registered with <a href="www.millimudafaa.com"
                        style="font-weight: 700;color: #939598; " class="link">MilliMudafaa.com</a> using this email
                    address. To stop receiving marketing emails from <strong>Milli Müdafaa</strong>, unsubscribe <a
                        href="#" style="text-decoration: underline; color: #939598;">here</a>.
                </p>
                <div class="footer-bottom-links" style="color: #939598;">
                    <a href="#" style="margin-right: 15px;">Gizlilik Politikası</a> | <a href="#"
                        style="margin-left: 15px;">KVKK</a>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
