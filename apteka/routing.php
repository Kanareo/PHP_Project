<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('hello'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('hello', 'HelloCtrl', ['user','admin']);
Utils::addRoute('login', 'LoginCtrl');
//Utils::addRoute('action_name', 'controller_class_name');