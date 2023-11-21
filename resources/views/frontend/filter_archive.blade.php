<div class="post-list-style-4">
    @foreach ($data as $item)
    <div class="post-item wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
        <div class="rt-post post-md style-9 grid-meta">
            <div class="post-content">
                @if (isset($item->Category()[0]))
                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.currentNewsCategory.list', $item->Category()[0]->link)) : (route('front.currentNewsCategory.list_en', $item->Category()[0]->link)) }}"
                        class="rt-cat-primary">{{ $item->Category()[0]->title }}</a>
                @endif
                <h3 class="post-title">
                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.currentNews.detail', $item->link)) : (route('front.currentNews.detail_en', $item->link)) }}"
                        class="restricted_title">
                        {{ $item->title }}
                    </a>
                </h3>
                <p class="restricted_text">
                    {{ $item->short_description }}
                </p>
                <div class="post-meta">
                    <ul>
                        <li>
                            <span class="rt-meta">
                                <i class="fa fa-user"></i> <a href=""
                                    class="name"> {{ $item->Author->name }} {{ $item->Author->surname }} </a>
                            </span>
                        </li>
                        <li>
                            <span class="rt-meta">
                                <i class="far fa-calendar-alt icon"></i>
                                {{ $item->live_date }}
                            </span>
                        </li>
                        <li>
                            <span class="rt-meta">
                                <i class="far fa-eye icon"></i>
                                {{ $item->view_counter }}
                            </span>
                        </li>
                        
                    </ul>
                </div>
                <div class="btn-wrap mt--25">
                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.currentNews.detail', $item->link)) : (route('front.currentNews.detail_en', $item->link)) }}"
                        class="rt-read-more qodef-button-animation-out">
                        {{ __('message.daha fazla oku') }}
                        <svg width="34px" height="16px" viewBox="0 0 34.53 16"
                            xml:space="preserve">
                            <rect class="qodef-button-line" y="7.6" width="34"
                                height=".4">
                            </rect>
                            <g class="qodef-button-cap-fake">
                                <path class="qodef-button-cap"
                                    d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z">
                                </path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="post-img">
                <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.currentNews.detail', $item->link)) : (route('front.currentNews.detail_en', $item->link)) }}">
                    <img src="/{{ $item->image != null ? $item->image : 'url (assets/frontend/media/gallery/post-lg_40.jpg)' }}"
                        alt="{{ $item->title }}" width="696" height="491">
                </a>

            </div>
        </div>
    </div>
    <!-- end post-item -->
@endforeach


</div>
<!-- end post-list-style-4 -->

<div style="margin-left: 35%; margin-top:5%">
    {{ $data->links() }}
</div>