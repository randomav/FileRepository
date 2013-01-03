<html>
<head>
<title>Регистрация</title>
</head>
<body>
<table align="center" style="position: relative;top: 40%;">
<form action="">
<tr><td>Логин</td><td><input name="Login" type="text"></td></tr>
<tr><td>Пароль</td><td><input name="Password" type="password"></td></tr>
<tr><td>Имя</td><td><input name="Name" type="text"></td></tr>
<tr><td>Возраст</td><td><input name="Age" type="text"></td></tr>
<tr><td>Пол</td><td><select name="Gender"><option selected value="М" >М</option><option value="Ж" >Ж</option></select></td></tr>
<tr><td colspan=2 align=center><input type="submit" value="Зарегистрировать"></td></tr>
<tr><td colspan=2 align=center><a href="?operation=authorize">К авторизации</a></td></tr>
<input type=hidden name="operation" value="adduser">
</form>
</table>
</body>
</html>