<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UJSP EXT SMS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
/* background-color: #fff;
color: #636b6f;*/
font-family: 'Raleway';
font-weight: 100;
height: 100vh;
margin: 0;
}

.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 28px;
}

.content {
    text-align: center;
    background-color: #ffffff;
}

.title {
    font-size: 15px;
    color: #d60202;
    background-color: #ffffff;
}

.links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
    display: inline-block;
}

.m-b-md {
    margin-bottom: 30px;
}
.thumb{
    align-content: left;
    position: absolute;
    left: 10px;
    top: 8px;
    width: 500px;
    height: 75px;
}
.particles-c{
  position: absolute;
  left: 0px;
  top: 100px;
  display: block;
  width: 100%;
  height: 500px;
}

h1 {
    font: 74 1.0em/1 'Raleway', sans-serif;
    /*color: rgba(0,0,0,.5);*/
    text-align: center;
    text-transform: uppercase;
    letter-spacing: .5em;
    position: absolute;
    top: 25%;
    width: 100%;
}

span, span:after {
    font-weight: 900;
    color: #fd2828;
    white-space: nowrap;
    display: inline-block;
    position: relative;
    letter-spacing: .09em;
    padding: .2em 0 .25em 0;
}

span {
    font-size: 4em;
    z-index: 100;
    text-shadow: .04em .04em 0 #9cb8b3;
}

span:after {
    content: attr(data-shadow-text);
    color: rgba(0,0,0,.35);
    text-shadow: none;
    position: absolute;
    left: .0875em;
    top: .0875em;
    z-index: -1;
    -webkit-mask-image: url(http://f.cl.ly/items/1t1C0W3y040g1J172r3h/mask.png);
}
</style>
</head>
<body>

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div >
            <img src="img/USJP.png" class="thumb" alt="a picture">
        </div>
        <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
        @endif
        <div id="particles-js" class="particles-c"></div>
        <div class="content">

            <div class="title m-b-md">
                {{-- Student Management System --}}
                <span data-shadow-text="Student Management System">Student Management System</span>
            </div>

            <div class="links">
                <a href="#"><marquee scrolldelay="200" scrollamount="3" direction="up" height="20">Documentation</marquee></a>
                <a href="#"><marquee scrolldelay="200" scrollamount="3" direction="up" height="20">Students Details</marquee></a>
                <a href="#"><marquee scrolldelay="200" scrollamount="3" direction="up" height="20">News</marquee></a>
                <a href="#"><marquee scrolldelay="200" scrollamount="3" direction="up" height="20">Exam Results</marquee></a>
                <a href="#"><marquee scrolldelay="200" scrollamount="3" direction="up" height="20">Time Tables</marquee></a>
                   {{--  <a href="#">New Results</a>
                    <a href="#">News</a>
                    <a href="#">Exam Results</a>
                    <a href="#">Time Tables</a> --}}
                </div>
            </div>
        </div>


        <!-- Scripts -->
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/particles.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/particles-custom.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> --}}
</body>
</html>
