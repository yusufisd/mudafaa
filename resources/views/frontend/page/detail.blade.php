@extends('frontend.master')
@section('title', $data->title )

@section('content')
    <!-- Start Main -->
    <main>
        <!-- theme-switch-box -->
        <div class="theme-switch-box-mobile-wrap">
            <div class="theme-switch-box-mobile">
                <span class="theme-switch-box-mobile__theme-status"><i class="fas fa-cog"></i></span>
                <label class="theme-switch-box-mobile__label" for="themeSwitchCheckboxMobile">
                    <input class="theme-switch-box-mobile__input" type="checkbox" name="themeSwitchCheckboxMobile"
                        id="themeSwitchCheckboxMobile">
                    <span class="theme-switch-box-mobile__main"></span>
                </label>
                <span class="theme-switch-box-mobile__theme-status"><i class="fas fa-moon"></i></span>
            </div>
        </div>
        <!-- end theme-switch-box-mobile -->

        <!-- Start inner page Banner -->
        <div class="banner inner-banner">
            <div class="container">
                <nav class="rt-breadcrumb-wrap" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('front.home')}}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$data->title}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start single-post-overlay area -->
        <div class="section-padding pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="rt-post-overlay rt-post-overlay-xl single-post-overlay">
                            <div class="post-img">
                                <a href="" class="img-link">
                                    <img src="/{{ $data->image }}" alt="post-ex_7" width="1320" height="620">
                                </a>
                            </div>
                        </div>
                        <!-- end single-post-overlay  -->
                    </div>
                    <!--  end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end single-post-overlay area -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-12 sticky-coloum-item">
                        <!-- strat psot body -->
                        <div class="post-body" style="justify:between">

                            {!! printDesc($data->description) !!}

                        </div>
                        <!-- end post body -->
                    </div>
                    <!-- end col-->

                </div>
                <!-- end row  -->
            </div>
            <!-- end container -->
        </section>
        <!-- end rt-sidebar-section-layout-2 -->

    </main>
    <!-- End Main -->
@endsection
