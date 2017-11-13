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

  <script src="{{ asset('../js/jquery.min.js') }}"></script>
  <script type="text/javascript" language="javascript">

    function load_subject(){
      var class_id = $('#class_id').val();
      var token = $('.token').val()
      $.ajax({
        type:'POST',
        url:'/search-subject',
        data: {_token: token, id: class_id},
        success:function(result){
          $('#loadSubjectDiv').html(result);
          load_chapter();
        }
      });
    }
    function load_chapter(){
      var class_id = $('#class_id').val();
      var subject_id = $('#subject_id').val();
      var token = $('.token').val()
      $.ajax({
        type:'POST',
        url:'/search-chapter',
        data: {_token: token, class_id: class_id, subject_id:subject_id},
        success:function(result){
          $('#loadChapterDiv').html(result);
          load_lesson()
        }
      });
    }

    function load_lesson(){
      var class_id = $('#class_id').val();
      var subject_id = $('#subject_id').val();
      var chapter_id = $('#chapter_id').val();
      var token = $('.token').val()
      $.ajax({
        type:'POST',
        url:'/search-lesson',
        data: {_token: token, class_id: class_id, subject_id:subject_id, chapter_id:chapter_id},
        success:function(result){
          $('#loadLessonDiv').html(result);
        }
      });
    }
  </script>
</head>

<body>
<header>
  <div class="row">
    <img src="images/header_image.png" alt="Header Image" />
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
            {{ Auth::user()->name }} <a href="{{ Auth::logout() }}" style="font-size:1rem">Logout</a></h5>
        @endif
      </div>

      <div style="clear: both"></div>
    </div>

  </div>
</header>
<div class="row">

  <div class="wrapper">
    <div class="large-9 medium-9 columns padding_left_none">
      <div class="large-12 medium-12 columns padding_left_none padding_right_none">
        @if (Auth::guest())
        <form action="" method="post">
          <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td> <select id="class_id" name="class_id" onChange="load_subject()" style="margin-bottom: 0rem;">
                  <option value="">CLASS</option>
                  @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                  @endforeach
                </select>
              </td>
              <td id="loadSubjectDiv"><select id="subject_id" name="subject_id" onChange="load_chapter()" style="margin-bottom: 0rem;">
                  <option value="">SUBJECT</option>
                  @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" >{{ $subject->subject_name }}</option>
                  @endforeach
                </select></td>
              <td  id="loadChapterDiv"><select id="chapter_id" name="chapter_id"  onchange="load_lesson()" style="margin-bottom: 0rem;">
                  <option value="">CHAPTER</option>
                  @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                  @endforeach
                </select></td>
              <td  id="loadLessonDiv"><select name="lesson_id" id="lesson_id" style="margin-bottom: 0rem;">
                  <option value="">LESSON</option>
                </select></td>
              <td> <select id="content_type_id" name="content_type_id" style="margin-bottom: 0rem;">
                  <option value="">CONTENT TYPE</option>
                  @foreach($content_types as $content_type)
                   <option value="{{ @$content_type->id }}">{{ @$content_type->content_type_name }}</option>
                  @endforeach
                </select></td>
            </tr>
            <tr style="background: none">
              <td colspan="5" align="right"><input type="button" value="SEARCH" class="button"></td>
            </tr>
          </table>
        </form>
        @else
        @endif
      </div>
      <div class="large-12 medium-12 columns padding_left_none padding_right_none clear">
        <div class="row">
          <div class="large-5 medium-5 columns padding_left_none padding_right_none">
            <p>Ang Lorem Ipsum ay ginagamit na modelo ng industriya ng pagpriprint at pagtytypeset. Ang Lorem Ipsum ang naging regular na modelo simula pa noong 1500s, noong may isang di kilalang manlilimbag and kumuha ng galley ng type at ginulo ang pagkaka-ayos nito upang makagawa ng libro ng mga type specimen. Nalagpasan nito hindi lang limang siglo, kundi nalagpasan din nito ang paglaganap ng electronic typesetting at nanatiling parehas. Sumikat ito noong 1960s kasabay ng pag labas ng Letraset sheets na mayroong mga talata ng Lorem Ipsum, at kamakailan lang sa mga desktop publishing software tulad ng Aldus Pagemaker ginamit ang mga bersyon ng Lorem Ipsum.</p>
          </div>
          <div class="large-7 medium-7 columns padding_right_none map_image_style">

            <img src="images/chart.png" alt="Chart" />
          </div>
        </div>
      </div>

      <div class="large-12 medium-12 columns padding_left_none padding_right_none clear margin-top">
        <div class="row">
          <div class="large-4 medium-4 columns padding_left_none ">
            <img src="images/game1.png" alt="">
            <h4 class="title2">Games</h4>
          </div>
          <div class="large-4 medium-4 columns padding_left_none">
            <img src="images/game2.png" alt="">
            <h4 class="title2">animation</h4>
          </div>
          <div class="large-4 medium-4 columns  padding_left_none">
            <img src="images/tumbnil.png" alt="">
            <h4 class="title2">videos</h4>
          </div>
        </div>
        <div class="row">
          <div class="large-4 medium-4 columns padding_left_none ">
            <img src="images/game1.png" alt="">
            <h4 class="title2">Games</h4>
          </div>
          <div class="large-4 medium-4 columns padding_left_none">
            <img src="images/game2.png" alt="">
            <h4 class="title2">animation</h4>
          </div>
          <div class="large-4 medium-4 columns  padding_left_none">
            <img src="images/tumbnil.png" alt="">
            <h4 class="title2">videos</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="large-3 medium-3 columns padding_right_none padding_left_none margin-bottom" style="overflow: hidden;">
      <div class="large-12 columns margin-bottom" style=" background: #66C0B7;">
        <form class="form-horizontal login_form" role="form" method="POST" action="{{ route('login') }}" >
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label clear_both">E-Mail Address</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

              @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label clear_both">Password</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
              <button type="submit" class="btn success button">
                Login
              </button>

              <a class="btn secondary button" href="{{ route('password.request') }}">
                Forgot Your Password?
              </a>
            </div>
          </div>
        </form>
        <p style="font-size: 20px; color:#fff">New User ? <a href="" title="Sign Up" class="login_button" style="font-size: 0.9rem">Sign Up</a></p>
      </div>
      <div style="clear: both"></div>
      <div class="large-12 medium-12 columns padding_right_none padding_left_none margin-bottom" style="height: 160px; border: solid 1px #66C0B4">
        Slider
      </div>
      <div class="large-12 medium-12 columns padding_right_none padding_left_none" style="border: solid 1px #66C0B4">
        <div style="position:relative;height:0;padding-bottom:75.0%">
          <!--<iframe src="https://www.youtube.com/embed/i9MHigUZKEM?ecver=2" width="480" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe>--></div>
      </div>
    </div>


  </div>
</div>


<footer>
  <div class="row padding-top padding-bottom" style="background: #13AFA2;">
    <h3 class="contact_title">Contact Us</h3>
    <div class="large-3 medium-3 columns">
      <div class="row">
        <div class="large-3 medium-3 columns"> <img src="images/location.png" alt="Location" width="58"> </div>
        <div class="large-9 medium-9 columns padding_left_none">
          <p>Address<br/>
            4/8 Humayun Road, Block-B, Mohammadpur, Dhaka - 1207, Bangladesh </p>
        </div>
      </div>
      <div class="row">
        <div class="large-3 medium-3 columns"> <img src="images/phone.png" alt="Location" width="55"> </div>
        <div class="large-9 medium-9 columns padding_left_none">
          <p>Phone<br/>
            +8809606016227 <br/>
            <br/>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="large-3 medium-3 columns"> <img src="images/globe.png" alt="Location" width="55"> </div>
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
        <p class="text_right"><a href="" title="Find us on facebook"><img src="images/facebook.png" alt="Facebbok" width="45" /></a></p>
        <p class="text_right"><a href="" title="Find us on facebook"><img src="images/google_plus.png" alt="Facebbok" width="45" /></a></p>
        <p class="text_right"><a href="" title="Find us on facebook"><img src="images/skype.png" alt="Facebbok" width="45" /></a></p>
        <p class="text_right"><a href="" title="Find us on facebook"><img src="images/youtube.png" alt="Facebbok" width="45" /></a></p>
      </div>
    </div>
  </div>
</footer>
<script src="{{ asset('/js/vendor/jquery.js') }}"></script>
<!--<script src="{{ asset('/js/vendor/what-input.js') }}"></script> -->
<script src="{{ asset('/js/vendor/foundation.js') }}"></script>
<!--<script src="{{ asset('/js/app.js') }}"></script> -->
</body>
</html>
