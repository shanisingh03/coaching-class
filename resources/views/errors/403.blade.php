<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name')}} | 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <!-- font files -->
    <link href="https://fonts.googleapis.com/css?family=Wallpoet" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Hind" rel="stylesheet" />
    <!-- /font files -->
    <!-- css files -->
    <link href="{{asset('frontend/error/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- /css files -->
</head>

<body>
    <div class="w3layouts-bg">
        <a href="{{route('welcome')}}">
            <h1 class="header-w3ls">{{config('app.name')}}</h1>
        </a>
        
        <div class="agileits-content">
            <h2><span>4</span><span>0</span><span>3</span></h2>
        </div>
        <div class="w3layouts-right">
            <div class="w3ls-text">
                <h3>Access Forbidden !</h3>
                <h4 class="w3-agileits2">the page you requested is not accessible to you.</h4>
                <p>Please go back to the <a href="{{route('home')}}">Home</a> page or contact us at <a
                        href="mailto:support@coachingclass.in">support@coachingclass.in</a></p>
                <p class="copyright">&copy; <script type="text/javascript">
                        document.write(new Date().getFullYear());

                    </script> Coaching Class. All Rights Reserved | <a href="https://coachingclass.in/"
                        target="_blank">Caoching Class</a></p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</body>

</html>
