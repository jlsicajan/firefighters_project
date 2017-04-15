@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Entrada</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input placeholder="Usuario" id="email" type="text" class="form-control"
                                           name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input placeholder="Contraseña" id="password" type="password" class="form-control"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Entrar al sistema
                                    </button>

                                    {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">--}}
                                    {{--Olvidaste tu contraseña?--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="/js/jquery.backstretch.min.js"></script>
    <script type="text/javascript">
        $.backstretch([
            "/images/background/1.JPG",
            "/images/background/2.JPG",
            "/images/background/3.JPG",
            "/images/background/4.JPG",
            "/images/background/5.JPG",
        ], {duration: 3000, fade: 750});
    </script>
@endsection