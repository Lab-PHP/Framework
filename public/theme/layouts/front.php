<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include(Config::path('app').'/public/theme/includes/meta.php');
        include(Config::path('app').'/public/theme/layouts/front/head.php'); ?>
    </head>
    <body>
        <?php require_once $content; 
        include(Config::path('app').'/public/theme/layouts/front/script.php'); ?>
    </body>
</html>