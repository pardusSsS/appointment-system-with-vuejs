<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\AppointmentNots;
use App\WorkingHours;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function getWorkingHours($date=''){
        $date = ($date=='') ? date('Y-m-d') : $date;
        $day = date("l",strtotime($date));
        $returnArray=[];
        $hours=WorkingHours::where('day',$day)->get();
        foreach ($hours as $k => $v){
           $control= Appointment::where('date',$date)->where('workingHour',$v['id'])->where(function ($control){
               $control->orWhere('isActive',APPOINTMENT_WAIT);
               $control->orWhere('isActive',APPOINTMENT_SUCCESS);
           })->count();
//           $control2 = Appointment::where('date',$date)->where('workingHour',$v['id'])->where('isActive',1)->count();

            //11.00 - 12.00
            // 0.    -   1. index
            $exp = explode('-','hours');
            $nowTime = date('H.i');//11.00

            $v['isActive']=($control == '0' and $exp[0] > $nowTime) ? true : false;
            $returnArray[]=$v;

        }

        return response()->json($returnArray);
    }

    public function appointmentStore(Request $request){
        $returnArray=[];
        $returnArray['status']=false;
        $all = $request->except('token');
        $control=Appointment::where('date',$all['date'])->where('workingHour',$all['workingHour'])->count();
        if($control != 0){
            $returnArray['message'] = "Bu randevu tarihi doludur";
            return response()->json($returnArray);
        }

        $all['code'] = substr(md5(uniqid()),0,6);
        $create = Appointment::create($all);
        if($create){
            $returnArray['status']=true;
            $returnArray['message']="Randevunuz başarılı bir şekilde oluşturulmuştur.";
        }else{
            $returnArray['message'] = 'Randevu oluşturulamadı. Lütfen bizimle iletişime geçiniz';
        }
        return response()->json($returnArray);

    }

    public function getWorkingStore(Request $request){
        $all = $request->except('__token');

        WorkingHours::query()->delete();

        foreach($all as $k=>$v){
            foreach($v as $key=>$value){
                WorkingHours::create([
                   'day'=>$k,
                    'hours'=>$value
                ]);
            }
        }

    }

    public function getWorkingList(){
        $returnArray=[];
        $data = WorkingHours::all();
        foreach($data as $k=>$v){
            $returnArray[$v['day']][] = $v['hours'];
        }

        return response()->json($returnArray);
    }

    public function appointmentDetail(Request $request){
        $returnArray = [];
        $returnArray['status'] = false;

        $all = $request->except('_token');
        $control = Appointment::where('code',$all['code'])->count();
        if($all['code']==""){
            $returnArray['message'] = "Lütfen kod alanını boş bırakmayınız";
            return response()->json($returnArray);
        }

        if($control == 0){
            $returnArray['message'] = "Bu kodla eşleşen randevu bulunamadı";
            return response()->json($returnArray);
        }

        $info = Appointment::where('code',$all['code'])->get();
        $info[0]['working'] = WorkingHours::getString($info[0]['workingHour']);
        $info[0]['notification'] = ($info[0]['notification_type'] === NOTIFICATION_EMAIL) ? 'Email' : 'Sms';
        $info[0]['status'] = ($info[0]['isActive'] == 0 ) ? 'Onay Bekliyor' : 'Onaylandı';
        $returnArray['status'] = true;
        $returnArray['info'] = $info[0];
        $returnArray['note'] = AppointmentNots::where('appointmentId',$info[0]['id'])->get();
        return response() -> json($returnArray);


    }
}
