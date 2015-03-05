<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- Вставьте внешние файлы и скрипты сюда (см. помощник HTML для детальной информации) -->
<?php echo $scripts_for_layout ?>
</head>
<body>

<!-- Здесь вы можете добавить меню, которое будет во всех представлениях -->
<div id="header">
    <div id="menu">...</div>
</div>

<!-- Тут будут вставляться представления -->
<?php echo $content_for_layout ?>

<!-- Подвал для каждой страницы -->
<div id="footer">...</div>

</body>
</html>