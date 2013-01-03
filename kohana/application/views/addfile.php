<html>
<head>
<title>Регистрация</title>
</head>
<body>
<table align="center" style="position: relative;top: 40%;">
<form action="" method="POST"  enctype="multipart/form-data">
<tr><td>Файл</td><td><input name="FileName" type="file"></td></tr>
<tr><td>Название</td><td><input name="Comment" type="text"></td></tr>
<tr><td colspan=2 align=center><input type="submit" value="Загрузить"></td></tr>
<tr><td colspan=2 align=center><a href="?operation=showfiles">К списку файлов</a></td></tr>
<input type=hidden name="operation" value="addfile">
</form>
</table>
</body>
</html>