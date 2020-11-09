<?php

$employeeController = 'App\Controller\EmployeeController';
$indexController = 'App\Controller\IndexController';

$route->addRoute('GET', '/', "$indexController/index");
$route->addRoute('GET', '/employee/{id:\d+}/edit', "$indexController/edit");
$route->addRoute('POST', '/employee/{id:\d+}/update', "$indexController/update");
$route->addRoute('POST', '/employee/{id:\d+}/delete', "$indexController/delete");

$route->addGroup('/api', function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/employees[/{page:\d+}[/{sort}[/{dir}]]]', "App\Controller\EmployeeController/list");
});
