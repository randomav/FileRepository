<html>
<head>
<title>Регистрация</title>
<style>
 table { 
    width: 100%; /* Ширина таблицы */
    border: 4px double black; /* Рамка вокруг таблицы */
    border-collapse: collapse; /* Отображать только одинарные линии */
   }
   th { 
    text-align: left; /* Выравнивание по левому краю */
    background: #ccc; /* Цвет фона ячеек */
    padding: 5px; /* Поля вокруг содержимого ячеек */
    border: 1px solid black; /* Граница вокруг ячеек */
   }
   td { 
    padding: 5px; /* Поля вокруг содержимого ячеек */
    border: 1px solid black; /* Граница вокруг ячеек */
   }
</style>
</head>
<body>
<table>
<form action="" id="Form">
<?if(!empty($delmsg))echo $delmsg?>
Файлов: <?=!empty($filecount) ? $filecount : "0"?> <a href="?operation=addfile">[Добавить файл]<a><a href='#' OnClick="document.getElementById('Form').submit();">[Удалить выделенные файлы]<a><a href="?operation=exit">[Выход]<a><br>
<tr><th>Имя файла</th><th>Владелец</th><th>Размер</th><th>Дата загрузки</th></tr>
<?
//print_r($files);
$numfile=0;
if(!empty($files))
foreach($files as $row){
echo "<tr><td>{$row->GetFileId()} <input type=checkbox name={$numfile}> {$row->GetComment()}</td><td>{$row->getOwner()}</td><td>{$row->getSize()}</td><td>{$row->getLoadTime()}</td></tr>\n\r";
$numfile++;
} else echo "<tr><td colspan=4 align=center>Файлов не загружено</td></tr>";
?>
<input type=hidden name="operation" value="deleteselected">
</form>
</table>
</body>
</html>