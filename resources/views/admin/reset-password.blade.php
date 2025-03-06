<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin reset password</title>
</head>
<body>
  <h2>reset password</h2>
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

  <form action="{{ route('admin_reset_password_submit') }}" method="post">
   @csrf
   <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="password" name="password" placeholder="Password">
     <input type="password" name="password_confirmation" placeholder="Confirm Password">
    <button type="submit">login</button>
  </form>
 


</body>
</html>
