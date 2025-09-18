@if (setting() && setting()?->management_team == 0)
     <div class="msg__wrapper">
         <div class="container">
             <div class="row">
                 <div class="info__text-wrapper text-center mb-5">
                     <h2> {{ $data['message']->title ?? '' }}</h2>
                     <h2> {{ $data['message']->sub_title ?? '' }}</h2>
                 </div>

                 <div class="event__wrapper">
                     <div class="swiper managementTeam2">
                         <div class="swiper-wrapper">
                             @foreach ($data['messages'] as $message)
                                 <div class="swiper-slide">

                                     <div class="about__items">
                                         <div class="img__holder">
                                             @if ($message->image)
                                                 <img src="{{ asset('storage/' . $message->image) }}" width="100%"
                                                     height="100%" alt="{{ $message->name }}">
                                             @else
                                                 <img src="{{ asset('no-image.png') }}" width="100%" height="100%"
                                                     alt="">
                                             @endif
                                         </div>
                                         <div class="text__holder text-center p-2">
                                             <h4>{{ $message->name }}</h4>
                                             <h6>{{ $message->designation }}</h6>
                                             <a href="{{ route('frontend.message', $message->slug) }}"
                                                 class="btn btn-hoverable2" target="_blank">Read
                                                 More
                                                 ></a>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @elseif (setting() && setting()?->management_team == 1)
     <div class="msg__wrapper">
         <div class="container">
             <div class="row py-5">
                 <div class="info__text-wrapper text-center mb-5">
                     <h2> {{ $data['message']->title ?? '' }}</h2>
                     <p>{{ $data['message']->sub_title ?? '' }}</p>
                 </div>

                 <div class="event__wrapper">
                     <div class="swiper managementTeam">
                         <div class="swiper-wrapper">
                             @foreach ($data['messages'] as $message)
                                 <div class="swiper-slide">

                                     <div class="message-item">
                                         <div class="img__holder">
                                             <img src="{{ asset('storage/' . $message->image) }}" width="100%"
                                                 height="100%" alt="">
                                         </div>
                                         <div class="text__holder"><a href="#" target="_blank">
                                                 <h6>{{ $message->name }}</h6>
                                                 <span>{{ $message->designation }}</span><br />
                                                 <p> {!! Str::limit(strip_tags($message->description), 60) !!}.</p>
                                                 <a href="{{ route('frontend.message', $message->slug) }}"
                                                     target="_blank">Read More ></a>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @else
 @endif  

 
 
 
