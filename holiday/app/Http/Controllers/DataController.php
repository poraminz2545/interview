<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public static function fetch_data(){
        $data = User::where('status','รอพิจารณา')->get();
        return $data;
    }
    public function regis_data(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phonenumber' => 'required',
            'type_holiday' => 'required',
            'reason' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $typeHoliday = $request->input('type_holiday');
        $from = Carbon::parse($request->input('from'));
        $to = Carbon::parse($request->input('to'));
        $today = Carbon::now();


        if ($from < $today) {
            return redirect()->back()->with('error', 'ไม่อนุญาติให้บันทึกวันลาย้อนหลัง');
        }


        if ($typeHoliday == '3') {

            $advanceNoticeRequiredDays = 3;
            $daysNotice = $from->diffInDays($today);
            if ($daysNotice < $advanceNoticeRequiredDays) {
                return redirect()->back()->with('error', 'กรณีพักร้อนลาล่วงหน้าอย่างน้อย 3 วัน');
            }


            $leaveDuration = $to->diffInDays($from) + 1;
            if ($leaveDuration > 2) {
                return redirect()->back()->with('error', 'กรณีพักร้อนลาติดต่อกันได้ไม่เกิน 2 วัน');
            }
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phonenumber');
        $user->type_holiday = $typeHoliday;
        $user->reason = $request->input('reason');
        $user->date_holiday_from = $request->input('from');
        $user->date_holiday_to = $request->input('to');
        $user->save();

        return redirect()->back()->with('success', 'Data registered successfully.');
    }

    public function search_data(Request $request){
        $data = $request->input('data');

        $data_search = User::where('name', 'LIKE', '%' . $data . '%')
        ->orWhere('date_holiday_from', 'LIKE', '%' . $data . '%')
        ->orWhere('date_holiday_to', 'LIKE', '%' . $data . '%')
        ->get();

        return view('search',['data' => $data_search]);
    }

    public function update_status(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $user = User::find($request->input('id'));

        $user->status = $request->input('status');
        $user->save();

        return redirect()->back();
    }

    public function delete_data(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::find($request->input('id'));
        $user->delete();

        return redirect()->back();
    }
}
