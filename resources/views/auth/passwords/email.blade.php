@extends('layout.master')

<!-- Main Content -->
@section('content')
<div class="panel">
    <h1>Reset Password</h1>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal col-md-4" role="form" method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>E-Mail Address</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

    
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
            </button>
        </form>
    </div>
</div>
@endsection
