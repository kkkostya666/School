<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <h1>Студент: {{ $student->first_name }} {{ $student->last_name }}</h1>
    <p>Дата рождения: {{ $student->date_of_birth }}</p>
    <p>Андресс: {{ $student->address_array }}</p>
    @if ($student->group)
        <p>Группа: {{ $student->group->name }}</p>
    @else
        <p>Группа: Не указана</p>
    @endif
</div>

