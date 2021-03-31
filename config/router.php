<?php

$app->get('/', \Controller\Home::class . ":index");
$app->post('/login', \Controller\User::class . ":login");
$app->post('/insertYear', \Controller\InsertYear::class . ":insertYear");
$app->post('/insertSubject', \Controller\InsertSubject::class . ":insertSubject");
$app->post('/insertSchedule', \Controller\InsertSchedule::class . ":insertSchedule");
