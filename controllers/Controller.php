<?php

    class Controller {
        public static function renderTemplate($view, $data) {
            extract($data);
            ob_start();

            if (file_exists($view)) {
                require $view;
            } else {
                echo 'Template not found!';
            }

            return ob_get_clean();
        }

        public static function renderPage() {
            echo 'Page rendered';
        }

        public static function handlePost() {
            echo 'Post method';
        }
    }
