@if(sliders()->isNotEmpty() )
    <div class="swiper-container main-slider">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach (sliders() as $slider)
                <div class="swiper-slide" style="background-image: url('{{ asset('storage/' . $slider->image) }}');"
                    data-title="{{ $slider->title }}" data-subtitle="{!! $slider->description !!}"></div>
            @endforeach

        </div>

        <!-- Slide captions -->
        <div class="slide-captions"></div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
@else
    <!-- slider  -->
    <div class="swiper-container main-slider">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide" style="background-image: url('{{ asset('frontend/assets/img/slider1.jpg') }}');"
                data-title="Slide<br> One" data-subtitle="This is a slide one"></div>
            <div class="swiper-slide" style="background-image: url('{{ asset('frontend/assets/img/slider2.jpg') }}');"
                data-title="Slide<br> Two" data-subtitle="This is a slide two"></div>
            <div class="swiper-slide" style="background-image: url('{{ asset('frontend/assets/img/slider3.jpg') }}');"
                data-title="Slide<br> Three" data-subtitle="This is a slide three"></div>
        </div>

        <!-- Slide captions -->
        <div class="slide-captions"></div>

        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
@endif
