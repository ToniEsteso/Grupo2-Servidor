<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Models\Carousel;

class CarouselController extends BaseController
{
    function GetAll(){
        return Carousel::get();
    }
    function Get($id){
        return Carousel::Where("id", $id)->get();
    }
}
