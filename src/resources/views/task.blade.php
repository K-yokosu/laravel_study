<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>task</title>
</head>
<body>
    <div>task画面</div>
    <a href="/profile">profileへ</a>
    <form action="/task/register" method="post">
        @csrf
        <label for="content">コンテンツ</label>
        <input type="text" name="content">
        <button type="submit">送信</button>
    </form>
</body>
</html>