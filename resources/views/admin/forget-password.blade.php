<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin forget password</title>
</head>
<body>
  <h2>forget password</h2>
  @if($errors->any())
    
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
  @endif
@if(Session::has('error'))
  <li>{{ session::get('error') }}</li>
@endif
@if(Session::has('success'))
  <li>{{ session::get('success') }}</li>
@endif

  <form action="{{ route('admin_forget_password_submit') }}" method="post">
   @csrf
    <input type="text" name="email" placeholder="Email">
    <button type="submit">login</button>
  </form>
  <a href="{{route('admin_login')}}" >back to login</a>


</body>
</html>
