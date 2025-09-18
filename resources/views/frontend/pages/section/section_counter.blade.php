   <section class="counter-section section-padding" style="margin-top: 50px">
       <div class="container">
           <div class="row d-flex align-items-center justify-content-center">
               <div class="col-lg-12 col-md-12">
                   <div class="d-flex justify-content-center flex-wrap" id="counter-section">
                       @foreach ($data['counters'] as $counter)
                           <div class="white__counter-box d-flex justify-content-between">
                               <div class="icon-image me-3">
                                   @if ($loop->index == 0)
                                       <img src="{{ asset('frontend/assets/img/icone-user.png') }}" alt="">
                                   @elseif ($loop->index == 1)
                                       <img src="{{ asset('frontend/assets/img/icon-file.png') }}" alt="">
                                   @elseif ($loop->index == 2)
                                       <img src="{{ asset('frontend/assets/img/icon-building.png') }}" alt="">
                                   @elseif ($loop->index == 3)
                                       <img src="{{ asset('frontend/assets/img/analytics.png') }}" alt="">
                                   @else
                                       <img src="{{ asset('frontend/assets/img/icone-user.png') }}" alt="">
                                   @endif
                               </div>
                               <div class="number-holder">
                                   <h1><span>{{ $counter->link }}</span>+</h1>
                                   <p class="fs-6">{{ $counter->name }}</p>
                               </div>
                           </div>
                       @endforeach

                   </div>
               </div>
           </div>
       </div>
   </section>
