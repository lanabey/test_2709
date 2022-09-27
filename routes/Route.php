<?php

    class Route {

        public static $routeList = array();

        public static function setRoute($path, $callback) {
            self::$routeList[] = $path;

            if ($_GET['url'] == $path) {
                $callback->__invoke();
            }
        }
    }
