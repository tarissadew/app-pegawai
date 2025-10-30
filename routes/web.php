<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalariesController;

Route::get('/', function(){
    return view('welcome');
}
);

Route::resource('employees', EmployeeController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('positions', PositionController::class);

Route::resource('attendances', AttendanceController::class);

Route::resource('salaries', SalariesController::class);