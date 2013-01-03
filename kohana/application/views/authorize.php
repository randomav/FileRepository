<html>
<head>
<title>Авторизация</title>
</head>
<body>
<table align="center" style="position: relative;top: 45%;">
<form action="" method="post">
<tr><td colspan=2 align=center><?=$msg?></td></tr>
<tr><td>Логин</td><td><input name="login" type="text"></td></tr>
<tr><td>Пароль</td><td><input name="password" type="password"></td></tr>
<tr><td colspan=2 align=center><input type="submit" value="Вход"><br><a href="?operation=registration">регистрация</a></td></tr>
<input type=hidden name="operation" value="authorize">
</form>
</table>
</body>
</html>