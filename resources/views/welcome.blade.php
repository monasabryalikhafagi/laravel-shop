<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                {{-- <div class="title m-b-md">
                    Welcome To Our Shop APIS 
                </div> --}}
                    <div class="container">
                    <div class="row">    	
                        <div class="col-md-8 col-md-offset-2">        	
                            <h3 class="text-center" style="margin-top: 30px;">How to integrate paypal payment in Laravel - websolutionstuff.com</h3>
                            <div class="panel panel-default" style="margin-top: 60px;">
                
                                @if ($message = Session::get('success'))
                                <div class="custom-alerts alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    {!! $message !!}
                                </div>
                                <?php Session::forget('success');?>
                                @endif
                
                                @if ($message = Session::get('error'))
                                <div class="custom-alerts alert alert-danger fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    {!! $message !!}
                                </div>
                                <?php Session::forget('error');?>
                                @endif
                                <div class="panel-heading"><b>Paywith Paypal</b></div>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                        {{ csrf_field() }}
                
                                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                            <label for="amount" class="col-md-4 control-label">Enter Amount</label>
                
                                            <div class="col-md-6">
                                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>
                
                                                @if ($errors->has('amount'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Paywith Paypal
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </body>
</html>
