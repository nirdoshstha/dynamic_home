<!-- footer  -->
<section id="footer">
    <div class="container">
        <div class="row text-left">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="brochure mb-3">


                    @if (setting()->brochure_image)
                        <a href="{{ setting()->brochure ? asset('storage/' . setting()->brochure) : 'javascript:void(0)' }}"
                            @if (setting()->brochure) target="_blank" @endif>
                            <img src="{{ asset('storage/' . setting()->brochure_image) }}" width="150">
                        </a>
                    @else
                        <a href="{{ setting()->brochure ? asset('storage/' . setting()->brochure) : 'javascript:void(0)' }}"
                            @if (setting()->brochure) target="_blank" @endif>
                            <img src="{{ asset('brochure_download.png') }}" width="150">
                        </a>
                    @endif
                </div>
                {{-- <h6>Visitor Counter</h6>     --}}
                @if (setting() && setting()?->is_counter == 0)
                    <div id="sfc228xt1t2wlsdgqsrpl9txwfng492sajl"></div>
                    <script type="text/javascript"
                        src="https://counter5.optistats.ovh/private/counter.js?c=228xt1t2wlsdgqsrpl9txwfng492sajl&down=async" async>
                    </script>
                    <noscript><a href="https://www.freecounterstat.com" title="free counter"><img
                                src="https://counter5.optistats.ovh/private/freecounterstat.php?c=228xt1t2wlsdgqsrpl9txwfng492sajl"
                                border="0" title="free counter" alt="free counter"></a></noscript>
                @endif

            </div>


            @if (usefulllinks()->isNotEmpty())
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <h5>Useful links</h5>
                    <ul class="list-unstyled quick-links">
                        @foreach (usefulllinks() as $usefullink)
                            <li><a href="{{ $usefullink->link }}" target="_blank"><i
                                        class="fa fa-angle-double-right"></i>{{ $usefullink->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="col-xs-12 col-md-6 col-lg-3 mb-3">
                    <h5>Useful links</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i>www.nrb.org.np/</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i>www.nrb.org.np/</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i>www.nrb.org.np/</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i>www.nrb.org.np/</a></li>
                    </ul>
                </div>
            @endif

            <div class="col-xs-12 col-md-6 col-lg-3">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="{{ route('frontend.index') }}" target="_blank"><i
                                class="fa fa-angle-double-right"></i>Home</a></li>
                    @if (about() && about()?->status == 0)
                        <li><a href="{{ route('frontend.about_single') }}" target="_blank"><i
                                    class="fa fa-angle-double-right"></i>About</a>
                        </li>
                    @endif

                    @if (album() && album()?->status == 0)
                        <li><a href="{{ route('frontend.photo_album') }}" target="_blank"><i
                                    class="fa fa-angle-double-right"></i>Gallery</a></li>
                    @endif
                    <li><a href="{{ route('frontend.contact') }}" target="_blank"><i
                                class="fa fa-angle-double-right"></i>Contact
                            Us</a></li>
                    <li><a href="{{ route('login') }}" target="_blank"><i
                                class="fa fa-angle-double-right"></i>Login</a></li>
                    <li><a href="{{ route('frontend.online_register') }}" target="_blank"><i
                                class="fa fa-angle-double-right"></i>Registration Form </a></li>
                </ul>
            </div>

            @if (!is_null(setting()))
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <h5>Address</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="#"><i class="fa-solid fa-home"></i>{{ setting()->address ?? '' }}</a></li>
                        <li><a href="tel: {{ setting()->phone ?? '' }}"><i
                                    class="fa-solid fa-phone"></i>{{ setting()->phone ?? '' }}</a>
                        </li>
                        <li><a href="{{ setting()->email ?? '' }}"><i
                                    class="fa-solid fa-envelope"></i>{{ setting()->email ?? '' }}</a></li>
                    </ul>
                </div>
            @else
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <h5>Address</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="#">Kathmandu-14 Bafal Kalanki</a></li>
                        <li><a href="tel: 01-5314491"><i class="fa-solid fa-phone"></i></i>01-5314491,9851278098</a>
                        </li>
                        <li><a href="mailto: dragon.scco@gmail.com"><i
                                    class="fa-solid fa-envelope"></i>dragon.scco@gmail.com</a></li>
                        <li><a href="mailto: info@dragonsaving.com.np"><i
                                    class="fa-solid fa-envelope"></i>info@dragonsaving.com.np</a></li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    @foreach (social_media() as $social)
                        <li class="list-inline-item"><a href="{{ $social->link }}"><i
                                    class="{{ $social->icon }}"></i></a></li>
                    @endforeach

                </ul>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p>2023 © All right Reversed | Designed by <a class="h6" href="https://allstar.com.np/"
                        target="_blank">All Star Technology</a></p>
            </div>
        </div>
    </div>
</section>
<!-- footer end -->
