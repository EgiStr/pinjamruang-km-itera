<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // cache response
        $data['rooms'] = cache()->remember('rooms', 60, function () {
            return Room::with('room_type')->get();
        });

        return view('index', compact('data'));
    }

    public function rooms()
    {
        $data['rooms'] = cache()->remember('rooms', 60, function () {
            return Room::with('room_type')->get();
        });
        return view('pages.rooms', compact('data'));
    }

    public function sop()
    {
        return view('pages.sop');
    }


}
