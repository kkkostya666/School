<!DOCTYPE html>
<html>
<head>
    <title>Спасибо за регистрацию</title>
</head>
<body>
<h1>Привет, {{ $user->name }}</h1>
<p>Твой аккаунт успешно создан</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Password:</strong> {{ $password }}</p>
</body>
</html>
