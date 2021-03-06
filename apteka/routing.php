<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('mainView'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('mainView', 'MainViewCtrl');

Utils::addRoute('browser', 'BrowserCtrl');
Utils::addRoute('browserData', 'BrowserCtrl');
Utils::addRoute('medInfo', 'MedInfoCtrl');
Utils::addRoute('medUpdate', 'MedUpdateCtrl', ['user','admin']);
Utils::addRoute('medUpdateSave', 'MedUpdateCtrl', ['user','admin']);

Utils::addRoute('order', 'OrderCtrl', ['user','admin']);
Utils::addRoute('orderAdd', 'OrderCtrl', ['user','admin']);
Utils::addRoute('orderClear', 'OrderCtrl', ['user','admin']);
Utils::addRoute('orderEdit', 'OrderEditCtrl', ['user','admin']);
Utils::addRoute('orderDelivered', 'OrderEditCtrl', ['user','admin']);
Utils::addRoute('orderDelete', 'OrderEditCtrl', ['user','admin']);

Utils::addRoute('userBrowser', 'UserBrowserCtrl', ['admin']);
Utils::addRoute('userBrowserData', 'UserBrowserCtrl', ['admin']);
Utils::addRoute('userInfo', 'UserInfoCtrl', ['admin']);
Utils::addRoute('userUpdate', 'UserUpdateCtrl', ['admin']);
Utils::addRoute('userUpdateSave', 'UserUpdateCtrl', ['admin']);
Utils::addRoute('userAdd', 'UserAddCtrl', ['admin']);
Utils::addRoute('userAddSave', 'UserAddCtrl', ['admin']);

Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user','admin']);
