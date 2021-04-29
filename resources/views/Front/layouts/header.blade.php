
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KimNeDedi &mdash;</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="KimNeDedi elit bir tartışma ve güncel bilgilerin olduğu bir platformdur." />
    <meta name="keywords" content="kimnededi, kim ne dedi, ünlü, son dakika, tartışma, platform, elit platform, elit tartışma yeri, ne dedi, ünlü kişi ne dedi," />

    <!-- Facebook and Twitter integration
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" /> -->

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> -->

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('front/')}}/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('front/')}}/css/icomoon.css">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{asset('front/')}}/css/simple-line-icons.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('front/')}}/css/bootstrap.css">
    <!-- Superfish -->
    <link rel="stylesheet" href="{{asset('front/')}}/css/superfish.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{asset('front/')}}/css/flexslider.css">

    <link rel="stylesheet" href="{{asset('front/')}}/css/style.css">


    <!-- Modernizr JS -->
    <script src="{{asset('front/')}}/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{asset('front/')}}/js/respond.min.js"></script>
    <![endif]-->
    @yield('css')
    <style>
        .navigation {
        display: none;
        }

        @media only screen and (max-width: 1024px) {
        .userDiscussion-description {
        padding: 10px 0;
        width: 30%;
        }
        .answeredDesc {
        padding: 10px 0 0 20px;
        width: 35% !important;
        }
        }

        @media only screen and (max-width: 770px) {
        .navigation {
        display: flex;
        background: #ddd;
        height: 50px;
        align-items: center;
        justify-content: space-around;
        }
        .navHome, .navMessages, .navWrite, .navNotifications {
        height: 100%;
        }
        .navigation a {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        }
        .connection-answers {
        height: 31px;
        }
        .discussions .userDiscussion {
        padding: 0 5px;
        }
        .discussions .userDiscussion .userInfo-and-answerBtn {
        padding: 0;
        }
        .userInfo-discussion h4, .answeredUserInfo h4 {
        font-size: 16px;
        }
        .userInfo-discussion h3, .answeredUserInfo h3 {
        font-size: 14px;
        }
        }
    </style>
</head>
<body>


