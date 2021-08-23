<?php

$app->get('/', \Controller\Home::class . ":index");
$app->post('/login', \Controller\User::class . ":login");
$app->get('/getImageFile', \Controller\User::class . ":getImageFile");
// Admin/year
$app->post('/insertYear', \Controller\InsertYear::class . ":insertYear");
$app->post('/getYear', \Controller\InsertYear::class . ":getYear");
$app->post('/delYear', \Controller\DelYear::class . ":delYear");
$app->post('/editYear', \Controller\EditYear::class . ":editYear");

// Admin/subject
$app->post('/insertSubject', \Controller\InsertSubject::class . ":insertSubject");
$app->post('/getSubject', \Controller\InsertSubject::class . ":getSubject");
$app->post('/delSubject', \Controller\DelSubject::class . ":delSubject");
$app->post('/editSubject', \Controller\EditSubject::class . ":editSubject");
// $app->post('/day', \Controller\Day::class . ":day");

// Teacher/subject
$app->post('/insertSchedule', \Controller\InsertSchedule::class . ":insertSchedule");

// Teacher/studuGroup
$app->post('/dropdownSubject', \Controller\DropdownStudyGroup::class . ":dropdownSubject");
$app->post('/dropdownYear', \Controller\DropdownStudyGroup::class . ":dropdownYear");
$app->post('/insertStudyGroup', \Controller\DropdownStudyGroup::class . ":insertStudyGroup");
$app->post('/getStudyGroup', \Controller\DropdownStudyGroup::class . ":getStudyGroup");
$app->post('/delStudyGroup', \Controller\DropdownStudyGroup::class . ":delStudyGroup");
$app->post('/editStudyGroup', \Controller\DropdownStudyGroup::class . ":editStudyGroup");
$app->post('/getNameStd', \Controller\DropdownStudyGroup::class . ":getNameStd");
$app->post('/delNameStd', \Controller\DropdownStudyGroup::class . ":delNameStd");

// Teacher/Schedule/Attend
$app->post('/dropdownSubSchedule', \Controller\InsertScheduleAttend::class . ":dropdownSubSchedule");
$app->post('/insertScheduleAttend', \Controller\InsertScheduleAttend::class . ":insertSchedule");
$app->post('/delScheduleAttend', \Controller\InsertScheduleAttend::class . ":delScheduleAttend");
$app->post('/editScheduleAttend', \Controller\InsertScheduleAttend::class . ":editScheduleAttend");
$app->post('/insertCompensate', \Controller\InsertScheduleAttend::class . ":insertCompensate");

$app->post('/getDay', \Controller\Day::class . ":getDay");

$app->post('/createImage', \Controller\UploadImage::class . ":createImage");
$app->post('/delImageinformation', \Controller\UploadImage::class . ":delImageinformation");


$app->post('/getStudyGroupStudent', \Controller\StudyGroupStudent::class . ":getStudyGroupStudent");
$app->post('/insertStudyGroupStudent', \Controller\StudyGroupStudent::class . ":insertStudyGroupStudent");
$app->post('/getStudent', \Controller\StudyGroupStudent::class . ":getStudent");

$app->post('/getNameStudent', \Controller\CheckName::class . ":getNameStudent");
$app->post('/checkName', \Controller\CheckName::class . ":checkName");
$app->post('/gettime', \Controller\CheckName::class . ":gettime");
