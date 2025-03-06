<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
  <h2>login</h2>
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

  <form action="{{ route('admin_login_submit') }}" method="post">
   @csrf
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">login</button>
  </form>


</body>
</html>
