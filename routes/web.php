<?php

use App\Livewire\Units\ListUnits;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\Unit;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    // $courses = Course::find(13);
    // dd(Storage::exists('/courses/01HZKRZPN1GVXWDTTZ2FEP2VVM.png'));

    $test = Unit::with("exercise")->get();
    dd($test);
});
