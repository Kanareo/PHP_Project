<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('mainView'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('mainView', 'MainViewCtrl');
Utils::addRoute('browser', 'BrowserCtrl');
Utils::addRoute('medInfo', 'MedInfoCtrl');
Utils::addRoute('medUpdate', 'MedUpdateCtrl', ['employee','admin']);
Utils::addRoute('medUpdateSave', 'MedUpdateCtrl', ['employee','admin']);
Utils::addRoute('cartAdd', 'CartCtrl', ['user']);
Utils::addRoute('cartSave', 'CartCtrl', ['user']);
Utils::addRoute('hello', 'HelloCtrl', ['user','admin']);
Utils::addRoute('adminPanel', 'PanelCtrl', ['admin']);
Utils::addRoute('userInfo', 'UserInfoCtrl', ['admin']);
Utils::addRoute('userUpdate', 'UserUpdateCtrl', ['admin']);
Utils::addRoute('userUpdateSave', 'UserUpdateCtrl', ['admin']);
Utils::addRoute('userAdd', 'UserAddCtrl', ['admin']);
Utils::addRoute('userAddSave', 'UserAddCtrl', ['admin']);
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user','admin']);


//Utils::addRoute('action_name', 'controller_class_name');