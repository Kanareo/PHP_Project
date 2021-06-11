<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('mainView'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('mainView', 'MainViewCtrl');
Utils::addRoute('browser', 'BrowserCtrl');
Utils::addRoute('hello', 'HelloCtrl', ['user','admin']);
Utils::addRoute('adminPanel', 'PanelCtrl', ['admin']);
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user','admin']);


//Utils::addRoute('action_name', 'controller_class_name');