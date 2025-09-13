<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
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

        .hoverable {
            border: none;
            border-radius: 0;
            padding: 3px 15px;
            /* color: #ee7d03; */
            background: transparent;
            position: relative;
            overflow: hidden;
            /* box-shadow: #ee7d03 0px 0px 0px 2px; */
        }

        .hoverable span {
            color: #ffffff;
            position: relative;
            z-index: 10;
            display: inline-block;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .school-display img {
            transition: 0.3s all ease-in-out;
        }

        .hoverable::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #00070e61;
            color: #ffffff;
            transform: translateX(-150%);
            transition: 0.3s all ease-in-out;
        }

        .hoverable:hover span {
            color: #fff !important;
        }

        .hoverable:hover::after {
            transform: translateX(0);
        }

        body>div {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .image-display {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(5, 0, 0);
            z-index: -99;
            display: none;
        }

        .display-all-time {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-color: red; */
            z-index: -99;
            display: none;
            transition: all 0.3s ease;
        }

        .image-display img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .college:hover+.image-display .college {
            display: block;
            transition: all 0.3s ease-in-out;

        }

        .school:hover+.image-display .school {
            display: block;
            transition: all 0.3s ease-in-out;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
            width: 400px;
            color: var(--bs-heading-color);
        }
    </style>

    <?php
    // $test = 'hello';
    // echo $test;
    ?>
    <?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'trilochan_new';
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    $sql = 'SELECT id, logo, background_image, school_image, college_image, popup_image,master_logo, school_title, college_title FROM settings';
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo '0 results';
    }
    $conn->close();
    
    ?>

</head>

<body class="main_body">
    @if (!is_null($row['popup_image']))
        <div id="ac-wrapper" style="display:none">
            <div id="popup">
                <center><a href="https://school.risingstar.edu.np"><img alt="Risingstar School/College"
                            class="img-responsive pull-center" src="http://localhost:8000/storage/<?php echo $row['popup_image']; ?>"
                            style="max-width: 555px; width: 100%;" title="Risingstar Academy School/College" /></a>
                    <!--<input type="submit" name="submit" value="Submit" onClick="PopUp('hide')" />--> <a
                        class="greeting-close" href="javascript:void(0);" onclick="PopUp('hide')">&times;</a></center>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div id="img_container">
            <div class="row py-0" style="margin-bottom: 90px;">
                <div class="col-lg-12  d-flex justify-content-center align-items-center">
                    @if (!is_null($row['master_logo']))
                        <img src="http://localhost:8000/storage/<?php echo $row['master_logo']; ?>" width="300px">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 school hoverable d-flex justify-content-center align-items-center py-3">
                    <a href="https://localhost:8000/" target="_blank">
                        <div class="text-center">
                            <h4 class=""><span><?php echo $row['school_title']; ?></span></h4>

                        </div>
                    </a>
                </div>
                <div class="col-md-6 college hoverable d-flex justify-content-center align-items-center py-3">
                    <a href="https://localhost:8000/" target="_blank">
                        <div class="text-center">
                            <h4 class=""><span><?php echo $row['college_title']; ?></span></h4>

                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="image-display display-all-time">
            <img class="image-all" src="http://localhost:8000/storage/<?php echo $row['background_image']; ?>" alt="School Image">
        </div>

        <div class="image-display school-display">
            <img class="school" src="http://localhost:8000/storage/<?php echo $row['school_image']; ?>" alt="School Image">
        </div>

        <div class="image-display college-display">
            <img class="college" src="http://localhost:8000/storage/<?php echo $row['college_image']; ?>" alt="College Image">
        </div>

        <!-- <div class="container">
      <div class="row">
        <div class="col-lg-3 d-flex justify-content-center align-items-center"><img src="https://school.risingstar.edu.np/storage/uploads/setting/240644fkjDBnraKa0yWs54D4IpneWXEZBtlVIqV9lemgnJ.png" width="150px"></div>
        <div class="col-lg-3 d-flex justify-content-center align-items-center "><img src="https://school.risingstar.edu.np/storage/uploads/setting/240644fkjDBnraKa0yWs54D4IpneWXEZBtlVIqV9lemgnJ.png" width="150px"></div>
        <div class="col-lg-3 d-flex justify-content-center align-items-center "><img src="https://school.risingstar.edu.np/storage/uploads/setting/240644fkjDBnraKa0yWs54D4IpneWXEZBtlVIqV9lemgnJ.png" width="150px"></div>
        <div class="col-lg-3 d-flex justify-content-center align-items-center "><img src="https://school.risingstar.edu.np/storage/uploads/setting/240644fkjDBnraKa0yWs54D4IpneWXEZBtlVIqV9lemgnJ.png" width="150px"></div>
      </div>
    </div> -->
        <div>

        </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(".display-all-time").css("display", "block");

        $(".school").hover(
            function() {
                $(".school-display").css({
                    "display": "block"
                });
            },

            function() {
                $(".school-display").css("display", "none");
                $(".display-all-time").css("display", "block");
            },
        );

        $(".college").hover(
            function() {
                $(".college-display").css("display", "block");
            },

            function() {
                $(".college-display").css("display", "none");
                $(".display-all-time").css("display", "block");
            },
        );

    });
</script>
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

</html>
