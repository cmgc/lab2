<?php

function autoload($class) {

    if (file_exists(LIBS_PATH . $class . '.php')) {
        require LIBS_PATH . $class . '.php';
    } else {
        exit ('Could not load class ' . $class);
    }
}

spl_autoload_register("autoload");

