
    @if (album() && album()->status == 0)

        @if ($data['videos']->isNotEmpty())
            <section id="video__album-section" class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="info__text-wrapper mb-3 text-center">
                            <h2> {{ $data['video']->title ?? '' }}</h2>
                            @isset($data['video']->video_link)
                                <p>{{ $data['video']->video_link ?? '' }}</p>
                            @endisset
                        </div>
                        @foreach ($data['videos'] as $video)
                            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mb-3">
                                <div class="video-item wow fadeInLeft" data-wow-delay="0.1s"
                                    style="visibility: visible; -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;">
                                    <iframe width="100%" height="250" src="{{ $video->video_link }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                    <div class="video__title text-center">
                                        <h6>{{ $video->title }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    @else
    @endif