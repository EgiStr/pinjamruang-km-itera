<?php

namespace App\Http\Controllers;

use App\Models\BorrowRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class borrowController extends Controller
{
    public function jadwal()
    {
        // get borrow room
        $data['borrow_rooms'] = DB::table('borrow_rooms')
            ->join('rooms', 'rooms.id', '=', 'borrow_rooms.room_id')
            ->join('admin_users', 'admin_users.id', '=', 'borrow_rooms.borrower_id')
            ->join('admin_user_details', 'admin_user_details.admin_user_id', '=', 'admin_users.id')
            ->select('borrow_rooms.*', 'rooms.name as room_name', 'admin_user_details.data as borrower_data')
            // where admin_approval_status = 1 and deleted_at = null
            ->where('borrow_rooms.admin_approval_status', '=', 1)
            ->where('borrow_rooms.deleted_at', '=', null)
            ->get()
            // get date only date from borrow_at and until_at
            ->map(function ($item) {
                $item->borrow_at = date('Y-m-d', strtotime($item->borrow_at));
                $item->until_at = date('Y-m-d', strtotime($item->until_at));
                $item->finished_at = date('Y-m-d', strtotime($item->finished_at));
                $item->borrower_data = json_decode($item->borrower_data);
                return $item;
            });

        // print data
        // dd($data);

        return view('pages.jadwal', compact('data'));
    }
}
