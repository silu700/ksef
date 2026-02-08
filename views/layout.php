<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>System Faktur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <h1>System Faktur</h1>
    <p><?= isset($page_title) ? $page_title : '' ?></p>
</div>

<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="index.php?page=faktury_lista">Przegląd faktur</a></li>
            <li><a href="index.php?page=faktury_dodaj">Wystaw fakturę</a></li>
            <li><a href="index.php?page=ustawienia">Ustawienia</a></li>
        </ul>
    </div>

    <div class="content">
        <?= $content ?>
    </div>
</div>

<script src="js/scripts.js?v=1"></script>

</body>
</html>
