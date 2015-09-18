<?php

class Redirect {

    public function to($location = null) {
        if ($location) {
            if (is_numeric($location)) {
                switch ($location) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        
                        include Config::path('app').'/web/views/front/page_404.php';
                        exit();
                        break;
                }
            }
            header('Location: ' . URL::to($location));
            exit();
        }
    }

}
