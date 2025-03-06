<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>

    <form action="{{ route('admin_logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
