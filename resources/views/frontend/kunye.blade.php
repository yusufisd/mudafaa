@extends('frontend.master')
@section('title', 'Künye')
@section('content')
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
                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('message.künye') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start team-seciton-style-1 -->
        <section class="team-seciton-style-1 motion-effects-wrap my-5">
            <div class="container">
                <table id="table_tag" class="table-hover table-responsive table">
                    <tbody>
                        @foreach ($data as $item)
                            
                        <tr>
                            <th scope="row" class="table_tag_th">{{ $item->title }}</th>
                            <td class="table_tag_td">{{ $item->description }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <!-- end container -->
        </section>
        <!-- end team-seciton-style-1 -->

    </main>
@endsection
