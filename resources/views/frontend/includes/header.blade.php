<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/lightbox2-2.11.3/dist/css/lightbox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <meta name="keywords" content="@yield('seo_keyword')" />
    <meta name="description" content="@yield('seo_description')" />
    @if (!is_null(setting()->fav_icon))
        <link href="{{ asset('storage/' . setting()->fav_icon) }}" rel="icon">
    @endif
    <title>@yield('title')</title>

    @stack('css')
    <style>
     

        header .top__header {
            padding: 5px 0;
            background-color: {{ setting()?->primary_color }};
        }

        header .navbar .dropdown-menu li a:hover {
            background-color: {{ setting()?->primary_color }} !important;
            color: #fff !important;
        }

        header .navbar {
            background-color: {{ setting()?->navbar_color }};
        }

        header .navbar .dropdown-menu {
            border: none;
            background-color: {{ setting()?->navbar_color }};
            box-shadow: rgba(153, 200, 0, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px !important;

        }

        h3 {
            font-weight: 800;
            font-size: 40px;
            line-height: 42px;
            color: {{ setting()?->title_color }};
            margin: 0;
        }

        .info__text-wrapper h2 {
            color: {{ setting()?->title_color }};
        }


        /* header .navbar .nav-item .nav-link {
                color: #ffffff;
                font-weight: 500;
            } */

        #footer {
            padding: 60px 0 0 0;
            background: linear-gradient(to right, {{ setting()?->primary_color }}, {{ setting()?->secondary_color }});
        }

        a {
            color: #089104 rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));
            /* text-decoration: underline; */
        }

        .annoncementBox .spTitle {
            background-color: {{ setting()?->primary_color }};
            color: #fff;
            padding: 18px 20px 16px 20px;
            font-size: 16px;
            font-family: 'proxima_novalight';
            text-transform: uppercase;
            float: left;
            position: relative;
        }
    </style>


</head>
