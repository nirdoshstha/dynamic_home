<!DOCTYPE html>
<html lang="en"><!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=Edge" />
    <title>Trilochan Academy::</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
    <!----------------------Styles ---------------------------->
    <link href="main-page/images/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="main-page/css/home.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #ac-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, .6);
            z-index: 1001;
        }

        #popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, .6);
            z-index: 1001;
            text-align: center;
            padding: 30px 20px 0 15px;
        }

        div#popup center {
            position: relative;
            display: inline-block;
        }

        .greeting-close {
            position: absolute;
            right: -15px;
            top: -15px;
            width: 30px;
            height: 30px;
            background: #074f96 !important;
            z-index: 99;
            opacity: 1;
            color: #fff;
            text-shadow: none;
            border-radius: 50%;
            float: right;
            font-size: 24px;
            line-height: 30px;
            text-decoration: none;
            filter: alpha(opacity=20);
        }

        .greeting-close:hover {
            color: #fff;
            opacity: 0.9;
        }
    </style>
    <!---------------------- Java scripts ----------------------------------->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {



            function setHeight() {
                windowHeight = $(window).innerHeight();
                $('.heroFullWrap').css('min-height', windowHeight);
            };
            setHeight();
            $(window).resize(function() {
                setHeight();
            });
        });
    </script>
</head>

<body data-gr-ext-installed="" data-new-gr-c-s-check-loaded="14.994.0">
    <div id="ac-wrapper" style="display:none">
        <div id="popup">
            <center><a href="https://trilochanacademy.edu.np/"><img alt="Trilochan Academy School/College"
                        class="img-responsive pull-center" src="images/pop-up-image.jpg"
                        style="max-width: 555px; width: 100%;" title="Trilochan Academy School/College" /></a>
                <!--<input type="submit" name="submit" value="Submit" onClick="PopUp('hide')" />--> <a
                    class="greeting-close" href="javascript:void(0);" onclick="PopUp('hide')">&times;</a></center>
        </div>
    </div>

    <div class="HeroCat-chooser">
        <div class="catOption">
            <div class="overlayopt"></div>

            <div class="catoptBody">
                <h1><a href="college">Trilochan <small>College of management</small></a></h1>
                <marquee behavior="scroll" direction="left">Here is some scrolling text... right to left!</marquee>

                <p><a href="college"><span class="btn-access">Click Website</span></a></p>
            </div>
        </div>

        <div class="catOption">
            <div class="overlayopt"></div>

            <div class="catoptBody">
                <h1><a href="school">Trilochan <small>secondary school</small></a></h1>

                <p><a href="school"><span class="btn-access">Click Website</span></a></p>
            </div>
        </div>
    </div>
    <script>
        function PopUp(hideOrshow) {
            if (hideOrshow == 'hide')
                document.getElementById('ac-wrapper').style.display = "none";
            else
                document.getElementById('ac-wrapper').removeAttribute('style');
        }
        window.onload = function() {
            PopUp('show');
        };
    </script>
</body>

</html>
