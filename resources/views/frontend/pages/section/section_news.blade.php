 @if (news() && news()?->status == 0){

     <div class="news-and-events__section section-margin">
         <div class="container">
             <div class="row">
                 @if ($data['news_events']->isNotEmpty())
                     <div
                         class="col-lg-{{ setting()?->notice_board == 0 ? '9' : '12' }} col-md-12 col-sm-12 mb-0 text-center">
                         <div class="">
                             <div class="info__text-wrapper text-center">
                                 <h2> {{ $data['news_event']->title ?? '' }}</h2>
                                 @isset($data['news_event']->sub_title)
                                     <p>{{ $data['news_event']->sub_title ?? '' }}</p>
                                 @endisset
                             </div>

                             <a href="{{ route('frontend.news_events') }}" target="_blank" class="float-end mb-3">All
                                 Events
                                 <i class="fa-solid fa-arrow-right"></i></a>
                         </div>
                         <div class="event__wrapper">
                             <div class="swiper newSlider">
                                 <div class="swiper-wrapper">
                                     @foreach ($data['news_events'] as $news)
                                         <div class="swiper-slide">

                                             <a href="#" data-bs-toggle="modal"
                                                 data-bs-target="#news-info-{{ $news->id }}">
                                                 <div class="event-item">
                                                     <div class="event-image">
                                                         @isset($news->image)
                                                             <img src="{{ asset('storage/' . $news->image) }}"
                                                                 alt="{{ $news->title }}">
                                                         @endisset

                                                     </div>
                                                     <div class="date">
                                                         <span>{{ $news->created_at->format('Y-m-d') }}</span>
                                                     </div>
                                                     <div class="event-details">
                                                         <h6>{!! Str::limit(strip_tags($news->description), 50) !!}</h6>
                                                     </div>
                                                 </div>
                                             </a>
                                         </div>
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                     </div>
                 @else
                     {{-- <div class="col-lg-9 col-md-12 col-sm-12 mb-4">
                        <div class="news-top__header d-flex justify-content-between flex-wrap mb-4">
                            <h2>News & Events</h2>
                            <a href="News-event.html">All Events <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="event__wrapper">
                            <div class="swiper newSlider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="#">
                                            <div class="event-item">
                                                <div class="event-image">
                                                    <img src="{{ asset('frontend/assets/img/info.jpg') }}"
                                                        alt="">
                                                </div>
                                                <div class="date">
                                                    <span>2022-02-29</span>
                                                </div>
                                                <div class="event-details">
                                                    <h6>Lorem ipsum dolor sit, amet consect adipisicing elit.</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                 @endif

                 @if (setting()?->notice_board == 0)
                     <div class="col-lg-3 col-md-12 col-sm-12">
                         <div class="right-notice  wow fadeInUp" data-wow-delay="0.1s"
                             style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                             <div class="card">
                                 <div class="card-body">
                                     <h5>Notice Board</h5>
                                     <hr>
                                     <ul id="style-7">
                                         @forelse ($data['notices'] as $notice)
                                             <li>
                                                 <a href="#" data-bs-toggle="modal"
                                                     data-bs-target="#MoreInfo-{{ $notice->id }}">
                                                     <p class="fw-bold">{{ $notice->title }}</p>
                                                     <p>{!! Str::limit(strip_tags($notice->description), 100) !!}</p>
                                                     <span><i class="fa-solid fa-calendar-days"></i>
                                                         {{ $notice->created_at->format('Y-m-d') }}</span>
                                                 </a>
                                             </li>
                                         @empty
                                         @endforelse

                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @else
                     {{-- <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="right-notice  wow fadeInUp" data-wow-delay="0.1s"
                            style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Notice Board</h5>
                                    <hr>
                                    <ul id="style-7">
                                        <li>
                                            <a href="#">
                                                <!-- <i class="fa-solid fa-circle-dot"></i> -->
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Cupiditate
                                                    mollitia quibusdam autem maxime assumenda.</p>
                                                <span><i class="fa-solid fa-calendar-days"></i> 2022-02-29</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                 @endif

             </div>
         </div>
     </div>
     }
 @else
 @endif
