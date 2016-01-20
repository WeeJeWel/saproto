<form method="POST" action="{{ route('login::show') }}">

    {!! csrf_field() !!}

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
                Materialize.toast('{{ $error }}', 3000, 'rounded')
            </script>
        @endforeach
    @endif

    <div class="form-group">
        <label for="recipient-name" class="control-label">Username:</label>
        <input type="text" class="form-control" id="username" name="email" placeholder="s1234567">
    </div>
    <div class="form-group">
        <label for="message-text" class="control-label">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="correct horse battery staple">
    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox" id="remember" name="remember"> Remember me
        </label>
    </div>

    <hr>

    <button type="submit" class="btn btn-success">Authenticate</button>

    <a class="btn btn-default pull-right" href="{{ route('login::resetpass') }}">Forgot your password?</a>

</form>