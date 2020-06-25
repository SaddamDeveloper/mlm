<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Member Panel</title>

    <!-- Bootstrap -->
    <link href="{{asset('member/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('member/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('member/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('member/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href={{asset('member/build/css/custom.min.css')}} rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {{ Form::open(array('url' => 'member/login', 'method' => 'post')) }}

              <h1>Member Login Form</h1>
              <div>
                @if ($message = Session::get('login_error'))
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @endif

                {{ Form::text('login_id', '',array('class' => 'form-control','placeholder'=>'Enter Login ID','required')) }}
                @error('login_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{ Form::password('password',array('class' => 'form-control','placeholder'=>'Enter Password')) }}
              </div>
              <div>
                {{ Form::submit('Log In', array('class'=>'btn btn-warning btn-block')) }}
              </div>

              <div class="clearfix"></div>
            {{ Form::close() }}
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
