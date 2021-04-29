<?php

namespace App\Http\Controllers\api\admin;

use App\Appointment;
use App\AppointmentNots;
use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\String_;

class indexController extends Controller
{

    public function detailStore(Request $request){
        $all = $request->except('_token');
        $create = AppointmentNots::create([
                'appointmentId'=>$all['id'],
                 'text'=>$all['text'],
        ]);

        if($create){
            $returnArray['status'] = true;
        }else{
            $returnArray['status'] = false;
        }

        return response()->json($returnArray);
    }

    public function detail($id){

        $returnArray=[];
        $data = Appointment::where('id',$id)->get();
        $data[0]['working'] = WorkingHours::getString($data[0]['workingHour']);
        $data[0]['notification'] = ($data[0]['notification_type'] == NOTIFICATION_EMAIL) ? 'Email' : 'Sms';
        $returnArray['data'] = $data[0];
        $returnArray['comment'] = AppointmentNots::where('appointmentId',$id)->orderBy('id','desc')->get();
        return response()->json($returnArray);

    }

    public function all(){
        $returnarray['future'] = Appointment::where('isActive',APPOINTMENT_SUCCESS)->  where('date','>',date('Y-m-d'))->orderBy('workingHour','asc')->get();
        $returnarray['future'] ->transform(function ($value){
            $value['working'] = WorkingHours::getString($value['workingHour']);
            return $value;
        });

        $returnarray['today'] = Appointment::where('isActive',APPOINTMENT_SUCCESS)->where('date',date('Y-m-d'))->orderBy('workingHour','asc')->get();
        $returnarray['today'] ->transform(function ($value){
            $value['working'] = WorkingHours::getString($value['workingHour']);
            return $value;
        });

        $returnarray['past']=Appointment::where('date','<',date('Y-m-d'))->orderBy('workingHour','asc')->get();
        $returnarray['past']->transform(function ($value){
            $value['working']=WorkingHours::getString($value['workingHour']);
            return $value;
        });

        $returnarray['wait'] = Appointment::where('isActive',APPOINTMENT_WAIT)->orderBy('workingHour','asc')->get();
        $returnarray['wait'] ->transform(function ($value){
            $value['working'] = WorkingHours::getString($value['workingHour']);
            return $value;
        });

       $returnarray['cancel']=Appointment::where('isActive',APPOINTMENT_CANCEL)->orderBy('workingHour','asc')->get();
       $returnarray['cancel']->transform(function ($value){
            $value['working']=WorkingHours::getString($value['workingHour']);
            return $value;
        });

        return response()->json($returnarray);
    }
//
//    public function getFutureList(){
//
//        $data = Appointment::where('isActive',1)->  where('date','>',date('Y-m-d'))->orderBy('workingHour','asc')->get();
//        $data ->transform(function ($value){
//            $value['working'] = WorkingHours::getString($value['workingHour']);
//            return $value;
//        });
//        return response()->json($data);
//    }
//
//    public function getTodayList(){
//
//        $data = Appointment::where('isActive',1)->where('date',date('Y-m-d'))->orderBy('workingHour','asc')->get();
//        $data ->transform(function ($value){
//            $value['working'] = WorkingHours::getString($value['workingHour']);
//            return $value;
//        });
//        return response()->json($data);
//    }
//
//    public function getPastList(){
//        $data=Appointment::where('date','<',date('Y-m-d'))->orderBy('workingHour','asc')->get();
//        $data->transform(function ($value){
//           $value['working']=WorkingHours::getString($value['workingHour']);
//           return $value;
//        });
//
//        return response()->json($data);
//    }
//
//
//    public function getWait(){
//
//        $data = Appointment::where('isActive',0)->orderBy('workingHour','asc')->get();
//        $data ->transform(function ($value){
//            $value['working'] = WorkingHours::getString($value['workingHour']);
//            return $value;
//        });
//        return response()->json($data);
//    }
//
//
    public function waitCheck(Request $request){
        $all = $request->except('_token');
        Appointment::where('id',$all['id'])->update(['isActive'=>$all['type']]);
        return response()->json(['status'=>true]);
    }
//
//
////    public function getList(){
////        $data=Appointment::where('isActive',0)->orderBy('workingHour','asc')->get();
////        $data->transform(function ($value){
////            $value['working']=WorkingHours::getString($value['workingHour']);
////            return $value;
////        });
////
////        return response()->json($data);
////    }
//
//
//    public function cancelList(){
//        $data=Appointment::where('isActive',2)->orderBy('workingHour','asc')->get();
//        $data->transform(function ($value){
//            $value['working']=WorkingHours::getString($value['workingHour']);
//            return $value;
//        });
//
//        return response()->json($data);
//    }
}
