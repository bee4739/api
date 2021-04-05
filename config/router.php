<?php

$app->get('/', \Controller\Home::class . ":index");
$app->post('/login', \Controller\User::class . ":login");

$app->post('/insertYear', \Controller\InsertYear::class . ":insertYear");
$app->post('/getYear', \Controller\InsertYear::class . ":getYear");
$app->post('/delYear', \Controller\DelYear::class . ":delYear");
$app->post('/editYear', \Controller\EditYear::class . ":editYear");

$app->post('/insertSubject', \Controller\InsertSubject::class . ":insertSubject");
$app->post('/getSubject', \Controller\InsertSubject::class . ":getSubject");
$app->post('/delSubject', \Controller\DelSubject::class . ":delSubject");
$app->post('/editSubject', \Controller\EditSubject::class . ":editSubject");

$app->post('/insertSchedule', \Controller\InsertSchedule::class . ":insertSchedule");
