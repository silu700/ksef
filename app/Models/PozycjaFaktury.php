<?php
$page = $_GET['page'] ?? 'faktury_lista';

switch($page) {
    case 'faktury_lista':
        require __DIR__ . '/../app/Controllers/FakturaController.php';
        $controller = new FakturaController();
        $controller->lista();
        break;
        
    case 'faktury_dodaj':
        require __DIR__ . '/../app/Controllers/FakturaController.php';
        $controller = new FakturaController();
        $controller->dodaj();
        break;
        
    case 'ustawienia':
        require __DIR__ . '/../views/ustawienia.php';
        break;
        
    default:
        echo "Strona nie istnieje";
        break;
}