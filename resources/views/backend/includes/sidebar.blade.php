<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item ">
            <a class="nav-link " href="{{ route('dashboard.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-heading">Pages</li>

        <li class="nav-item active">
            <a class="nav-link collapsed" data-bs-target="#home-nav" data-bs-toggle="collapse" href="#"
                aria-expanded="false">
                <i class="bi bi-house-fill"></i><span>Home</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="home-nav" class="nav-content collapse  @if (\Route::is('slider.index')) show @endif"
                data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{ route('slider.index') }}" class=" @if (\Route::is('slider.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Slider</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('testimonial.index') }}" class=" @if (\Route::is('testimonial.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Testimonial</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('modal.index') }}" class=" @if (\Route::is('modal.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Modal</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('alumni.index') }}" class=" @if (\Route::is('alumni.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Alumni</span>
                    </a>
                </li>
                <li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"
                aria-expanded="false">
                <i class="bi bi-layout-text-window-reverse"></i><span>About Us</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse  @if (\Route::is('category.index', 'about.index')) show @endif"
                data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{ route('category.index') }}" class=" @if (\Route::is('category.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('about.index') }}" class=" @if (\Route::is('about.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Posts</span>
                    </a>
                </li>
            </ul>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('information.index') }}">
                <i class="bi bi-person"></i>
                <span>Information</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('kindergarten.index') }}">
                <i class="bi bi-person"></i>
                <span>Kindergarten</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('message.index') }}">
                <i class="bi bi-card-checklist"></i>
                <span>Messages</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed active" data-bs-target="#gallery-nav" data-bs-toggle="collapse" href="#"
                aria-expanded="false">
                <i class="bi bi-card-image"></i><span>Gallery</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="gallery-nav" class="nav-content collapse @if (\Route::is('album.index', 'video.index')) show @endif"
                data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{ route('album.index') }}" class="@if (\Route::is('album.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Album</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('video.index') }}" class="@if (\Route::is('video.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Video</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('news.index') }}">
                <i class="bi bi-stack"></i>
                <span>News And Events</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('notice.index') }}">
                <i class="bi bi-card-list"></i>
                <span>Notice</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('download.index') }}">
                <i class="bi bi-save-fill"></i>
                <span>Download</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed @if (\Route::is('useful_links.index', 'top_navbar_links.index')) active @endif"
                data-bs-target="#general-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-card-image"></i><span>General</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="general-nav" class="nav-content collapse @if (\Route::is('useful_links.index', 'top_navbar_links.index')) show @endif"
                data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a href="{{ route('useful_links.index') }}"
                        class="@if (\Route::is('useful_links.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Useful Links</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('top_navbar_links.index') }}"
                        class="@if (\Route::is('top_navbar_links.index')) active @endif">
                        <i class="bi bi-circle"></i><span>Top Navbar Links</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('contact.index') }}">
                <i class="bi bi-envelope"></i>

                <span>Contact Us ({{ countContact() }})</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('online_register.index') }}">
                <i class="bi bi-envelope"></i>

                <span>Online Register ({{ countRegister() }})</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('scrolling_text.index') }}">
                <i class="bi bi-envelope"></i>

                <span> Scrolling Text</span>
            </a>
        </li>



    </ul>

</aside><!-- End Sidebar-->
