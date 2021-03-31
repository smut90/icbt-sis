<?php

/**
 * This is an example of a front controller for a flat file PHP site. Using a
 * Static list provides security against URL injection by default. See README.md
 * for more examples.
 */
# [START gae_simple_front_controller]
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'index.php';
        break;
    case '/index.php':
        require 'index.php';
        break;
    case '/students':
        require 'students/index.php';
        break;
    case '/students/index':
        require 'students/index.php';
        break;
    case '/students/add':
        require 'students/add.php';
        break;
    case '/students/add.php':
        require 'students/add.php';
        break;

    case '/departments':
        require 'departments/index.php';
        break;
    case '/departments/index':
        require 'departments/index.php';
        break;
    case '/departments/add':
        require 'departments/add.php';
        break;
    case '/departments/add.php':
        require 'departments/add.php';
        break;

    case '/courses':
        require 'courses/index.php';
        break;
    case '/courses/index':
        require 'courses/index.php';
        break;
    case '/courses/add':
        require 'courses/add.php';
        break;
    case '/courses/add.php':
        require 'courses/add.php';
        break;

    case '/modules':
        require 'modules/index.php';
        break;
    case '/modules/index':
        require 'modules/index.php';
        break;
    case '/modules/add':
        require 'modules/add.php';
        break;
    case '/modules/add.php':
        require 'modules/add.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}
# [END gae_simple_front_controller]
