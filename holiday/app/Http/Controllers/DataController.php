<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public static function fetch_data(){
        $data = User::where('status','รอพิจารณา')->get();
        // dd($data);
        return $data;
    }

    public function regis_data(Request $request){

        $timezone = 'Asia/Bangkok';
        // dd($request);
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
        $today = Carbon::now($timezone);
        // dd($today);

        if ($from < $today) {
            return redirect()->back()->with('error', 'ไม่อนุญาติให้บันทึกวันลาย้อนหลัง');
        }

        if ($typeHoliday == '3') {
            $advanceNoticeRequiredDays = 3;
            $daysNotice = $from->diffInDays($today);
            // dd($daysNotice);
            if ($daysNotice < $advanceNoticeRequiredDays) {
                return redirect()->back()->with('error', 'กรุณาพักร้อนลาล่วงหน้าอย่างน้อย 3 วัน');
            }


            $leaveDuration = $to->diffInDays($from) + 1;
            if ($leaveDuration > 2) {
                return redirect()->back()->with('error', 'กรุณาพักร้อนลาติดต่อกันได้ไม่เกิน 2 วัน');
            }
        }

        $user = new User;
        $user->name = $request->name;
        $user->phone_number = $request->phonenumber;
        $user->type_holiday = $request->type_holiday;
        $user->reason = $request->reason;
        // $date_arr = array($request->from,$request->to);
        $user->date_holiday_from = $request->from;
        $user->date_holiday_to = $request->to;
        // $date = implode(' - ',$date_arr);
        // dd($date);
        // $user->date_holiday_from_to = $date;
        $user->save();

        return redirect()->back();
    }

    public function search_data(Request $request){
        $data = $request->data;
        // dd($data);
        $data_search = User::where('name', 'LIKE','%'.$data.'%')
        ->orWhere('date_holiday_from', 'LIKE','%'.$data.'%')
        ->orWhere('date_holiday_to', 'LIKE','%'.$data.'%')
        ->get();
        return view('search', ['data_search' => $data_search]);
    }

    public function update_status(Request $request){
        if($request->input('id_status')){
            $user =User::find($request->id_status);
            $user->status = $request->input('status');
            $user->save();
            return view('alldata');
        }
    }

    public function delete_data(Request $request){
        if($request->input('id')){
            $user =User::find($request->id);
            $user->delete();
            return view('alldata');
        }
    }
}
