<?php

ini_set('session.gc_maxlifetime', 1209600);
session_set_cookie_params(1209600);

if (!session_id()) session_start();

require_once "../vendor/autoload.php";

require_once "config/environment.php";
require_once "config/database.php";

require_once "config/session.php";
require_once "config/validation.php";
require_once "config/queries.php";
require_once "config/utils.php";

require_once "core/Route.php";
require_once "core/Validator.php";

$route = new Route();
require_once "config/routes.php";

return $route->resolve();
