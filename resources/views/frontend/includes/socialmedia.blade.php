<div class="side__social-media">

    <ul>
        @foreach (social_media() as $socials)
            <li>
                <div class="{{ strtolower($socials->name) }}">
                    <a href="{{ $socials->link }}" target="_blank"><i class="{{ $socials->icon }}"></i></a>
                </div>
            </li>
        @endforeach
    </ul>





</div>
