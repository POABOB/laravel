<form action="{{ url('reset_password') }}" method="POST">
	{{ csrf_field() }}
	<input type="password" name="password">
	<input type="password" name="passconf">
	 @if($errors->any())
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            </ul>
                                @endforeach
                        </div>
     @endif

	<input type="submit" name="submit">
</form>