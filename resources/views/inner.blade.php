<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Class Room</title>
<link href="{{ asset('/css/foundation.css') }}" rel="stylesheet">
<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">



</head>

<body>
<header>
<div class="row">
	<img src="{{ asset('/images/header_image.png') }}" alt="Header Image" />
</div>
<div class="row" style="position: relative; padding:0; margin:0; background-color: #13AFA2">
	<div class="wrapper">
     <div class="large-9 medium-9 columns padding_right_none padding_left_none">
    <h3 class="title">smart classroom content</h3>
  </div>
  <div class="large-3 medium-3 columns padding_right_none padding_left_none" style=" background: #66C0B7; height: 4.5rem" id="login_panel1">
  @if (Auth::guest())
  @else
  	<h5 style="text-align: center; position: relative;
float: left;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);">
 	{{ Auth::user()->name }} <a href="{{ url('/logout') }}" style="font-size:1rem">Logout</a></h5>
  @endif
  </div>
 
  <div style="clear: both"></div>
    </div>
 
</div>
</header>
<div class="row">
<div class="wrapper">
	<div class="row margin-top">
        <div class="large-3 medium-3 columns padding_left_none padding_right_none">
        	<div class="callout">
            	<ul>
                  <li><a href="{{ url('/class-list') }}" title="Class List">Class List</a></li>
                  <li><a href="{{ url('/add-class') }}" title="Add New Class">Add New Class</a></li>
                  <li><a href="{{ url('/subject-list') }}" title="Subject List">Subject List</a></li>
                  <li><a href="{{ url('/add-subject') }}" title="Add New Subject">Add New Subject</a></li>
                  <li><a href="{{ url('/chapter-list') }}" title="Chapter List">Chapter List</a></li>
                  <li><a href="{{ url('/add-chapter') }}" title="Add New Chapter">Add New Chapter</a></li>
                  <li><a href="{{ url('/lesson-list') }}" title="Lesson List">Lesson List</a></li>
                  <li><a href="{{ url('/add-lesson') }}" title="Add New Lesson">Add New Lesson</a></li>
                  <li><a href="{{ url('/content-type-list') }}" title="Content Type">Content Type</a></li>
                  <li><a href="{{ url('/add-content-type') }}" title="Add New Content Type">Add New Content Type</a></li>

                  <li><a href="{{ url('/content-list') }}" title="Content Type">Content List</a></li>
                  <li><a href="{{ url('/add-content') }}" title="Add New Content Type">Add New Content</a></li>
                </ul>
            </div>
        </div>
		<div class="large-9 medium-9 columns padding_right_none">
       	 @yield('content')
        </div>
	</div>
</div>
</div>
<footer>
  <div class="row padding-top padding-bottom" style="background: #13AFA2;">
    <h3 class="contact_title">Contact Us</h3>
    <div class="large-3 medium-3 columns">
      <div class="row">
        <div class="large-3 medium-3 columns"> <img src="{{ asset('/images/location.png') }}" alt="Location" width="58"> </div>
        <div class="large-9 medium-9 columns padding_left_none">
          <p>Address<br/>
            4/8 Humayun Road, Block-B, Mohammadpur, Dhaka - 1207, Bangladesh </p>
        </div>
      </div>
      <div class="row">
        <div class="large-3 medium-3 columns"> <img src="{{ asset('/images/phone.png') }}" alt="Location" width="55"> </div>
        <div class="large-9 medium-9 columns padding_left_none">
          <p>Phone<br/>
            +8809606016227 <br/>
            <br/>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="large-3 medium-3 columns"> <img src="{{ asset('/images/globe.png') }}" alt="Location" width="55"> </div>
        <div class="large-9 medium-9 columns padding_left_none">
          <p>E-mail<br/>
            info@kite.com.bd </p>
        </div>
      </div>
    </div>
    <div class="large-8 medium-8 columns">
      <div class="row">
        <form action="" name="" id="" method="">
          <div class="large-5 medium-5 columns">
            <div class="large-12 columns">
              <label>Name</label>
              <input placeholder="large-4.columns" type="text">
            </div>
            <div class="large-12 columns">
              <label>Email</label>
              <input placeholder="large-4.columns" type="text">
            </div>
            <div class="large-12 columns">
              <label>Subject</label>
              <input placeholder="large-4.columns" type="text">
            </div>
          </div>
          <div class="large-7 medium-7 columns padding_right_none">
            <label>Message</label>
            <textarea name="" id=""></textarea>
            <input type="button" class="send button" name="" value="Send" />
          </div>
        </form>
      </div>
    </div>
    <div class="large-1 medium-1 columns social_icon">
      <div class="large-10 medium-2 ">
        <p class="text_right"><a href="" title="Find us on facebook"><img src="{{ asset('/images/facebook.png') }}" alt="Facebbok" width="45" /></a></p>
        <p class="text_right"><a href="" title="Find us on facebook"><img src="{{ asset('/images/google_plus.png') }}" alt="Facebbok" width="45" /></a></p>
        <p class="text_right"><a href="" title="Find us on facebook"><img src="{{ asset('/images/skype.png') }}" alt="Facebbok" width="45" /></a></p>
        <p class="text_right"><a href="" title="Find us on facebook"><img src="{{ asset('/images/youtube.png') }}" alt="Facebbok" width="45" /></a></p>
      </div>
    </div>
  </div>
</footer>




<script src="{{ asset('/js/vendor/jquery.js') }}"></script> 
<!--<script src="{{ asset('/js/vendor/what-input.js') }}"></script> -->
<script src="{{ asset('/js/vendor/foundation.js') }}"></script>
<!--<script src="{{ asset('/js/app.js') }}"></script> -->

</html>
