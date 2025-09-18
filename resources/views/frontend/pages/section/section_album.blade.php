@if (album() && album()->status == 0)
    @if (setting()?->gallery_design == 1)
        {{-- Single Gallery View --}}
        <div class="gallery-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top__header wow fadeInUp" data-wow-delay="0.1s">
                            <div class="info__text-wrapper text-center">
                                <h2>{{ $data['album']->title ?? '' }}</h2>
                                @isset($data['album']->sub_title)
                                    <p>{{ $data['album']->sub_title ?? '' }}</p>
                                @endisset
                            </div>
                        </div>

                        <div class="gg-box wow fadeInUp" data-wow-delay="0.2s">
                            @forelse ($data['galleries'] as $gallery)
                                <div class="gg-element">
                                    <a class="example-image-link" href="{{ image_path($gallery->url) }}"
                                        data-lightbox="example-set">
                                        <img src="{{ image_path($gallery->url) }}" alt="Gallery Image">
                                    </a>
                                </div>
                            @empty
                                <h4 class="text-center">No gallery images available.</h4>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @elseif (setting()?->gallery_design == 0)
        {{-- Album View --}}
        <section class="album-section py-5">
            <div class="container">
                <div class="top__header text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="info__text-wrapper text-center mb-4">
                        <h2>{{ $data['album']->title ?? '' }}</h2>
                        @isset($data['album']->sub_title)
                            <p>{{ $data['album']->sub_title ?? '' }}</p>
                        @endisset
                    </div>
                </div>

                <div class="album__image-section">
                    <div class="row">
                        @forelse ($data['albums'] as $album)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                                <a href="{{ route('frontend.photo_album_gallery', $album->slug) }}">
                                    <div class="album__item wow fadeInLeft" data-wow-delay="0.1s">
                                        <div class="overlay"></div>
                                        <div class="album-img__holder">
                                            @if ($album->images->count() > 0)
                                                <img src="{{ image_path($album->images->first()->url) }}" width="100%"
                                                    height="100%" alt="{{ $album->title }}">
                                            @else
                                                <img src="{{ asset('frontend/assets/img/info.jpg') }}" width="100%"
                                                    height="100%" alt="Default Image">
                                            @endif
                                        </div>
                                        <div class="album__title text-center">
                                            <h5>{{ $album->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <h4 class="text-center">No albums available.</h4>
                        @endforelse
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $data['albums']->links() }}
                </div>
            </div>
        </section>
    @endif
@else
@endif
