<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="{{asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('admin/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href={{asset('admin/build/css/custom.min.css')}} rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            {{ Form::open(array('url' => 'admin/login', 'method' => 'post')) }}

              <h1>{{__('Admin Login')}}</h1>
              <div>
                @if ($message = Session::get('login_error'))
                  <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @endif

                {{ Form::email('email', '',array('class' => 'form-control','placeholder'=>'Enter Email','required')) }}
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- <input type="text" class="form-control" placeholder="Username" required="" /> --}}
              </div>
              <div>
                {{ Form::password('password',array('class' => 'form-control','placeholder'=>'Enter Password')) }}
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div>
                {{ Form::submit('Log In', array('class'=>'btn btn-warning btn-block')) }}
                {{-- <a class="btn btn-default submit" type="submit">Log in</a> --}}
              </div>

              <div class="clearfix"></div>
            {{ Form::close() }}
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
