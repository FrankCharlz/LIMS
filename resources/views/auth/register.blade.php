@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            {{--
                             just so I understand: if an error is caught in the validation logic in the controller
                             declared for the action route, the Share,,data middleware will attach $errors valiable to this
                             view, hence the code below checks for error in the given input and adds a class [has-error]
                             for conviniently notifying user. Also a span [help-block] is added with firther instruction.
                             --}}


                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="fname" class="col-md-4 control-label">First name</label>
                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autofocus>

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('onames') ? ' has-error' : '' }}">
                                <label for="onames" class="col-md-4 control-label">Other names</label>
                                <div class="col-md-6">
                                    <input id="onames" type="text" class="form-control" name="onames" value="{{ old('onames') }}" required autofocus>

                                    @if ($errors->has('onames'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('onames') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Username</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone number</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-mail (<font color="#c71585">Optional</font>)</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr style="width: 64%; border: 1px solid #ededed;">

                            <div class="form-group{{ $errors->has('utype') ? ' has-error' : '' }}">
                                <label for="utype" class="col-md-4 control-label">User type</label>
                                <div class="col-md-6">
                                    <select id="utype" class="form-control" name="utype" required>
                                        <option value="INDIVIDUAL">Individual</option>
                                        <option value="ORGANIZATION">Organization</option>
                                    </select>

                                    @if ($errors->has('utype'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('utype') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr style="width: 64%; border: 1px solid #ededed;">

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
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
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
