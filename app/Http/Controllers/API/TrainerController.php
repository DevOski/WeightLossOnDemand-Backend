<?php

namespace App\Http\Controllers\API;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainersType;
use App\Models\Trainer;
use App\Models\AppRating;
use App\Models\TrainersSlot;

class TrainerController extends Controller
{
    public function trainertype(){
        $trainer=TrainersType::all();

        return response()->json([
            "status"=>200,
            "data"=>$trainer
        ],200);
    }
    public function trainers()
    {
        $all_tr=Trainer::get();
        return response()->json([
            'status'=>200,
            'data'=>$all_tr
        ]);
    }
    public function Slots()
    {
        $all_Slot=TrainersSlot::get();
        return response()->json([
            'status'=>200,
            'data'=>$all_Slot
        ]);
    }
    public function trTimeSlots($id){
        $tr_slots=TrainersSlot::where('tr_id', $id)->get();
        return response()->json([
            'status'=>200,
            'data'=>$tr_slots
        ]);
    }
    public function trCalenderSlots(Request $request){
        if($request->id != ""){
            if($request->date != ""){
                $tr_slots=TrainersSlot::where('tr_id', $request->id)->where('tr_date',$request->date)->get();
                return response()->json([
                    'status'=>200,
                    'data'=>$tr_slots
                ]);
            }else{
                return response()->json([
                    'status'=>403,
                    'message'=>"Slot date should be provided"
                ],403);    
            }
        }else{
            return response()->json([
                'status'=>403,
                'message'=>"Trainer ID should be provided"
            ],403);
        }
       
    }
    public function trainersList($type){
        // $trainer=Trainer::where('tr_name','LIKE','%c%')->get();
        $trainer=Trainer::where('type',$type)->get();
        return response()->json([
            "status"=>200,
            "data"=>$trainer
        ]);
    }
    public function trainerDesc($id){
        $trainers=Trainer::where('tr_id',$id)->first();
        $trainerSlot=TrainersSlot::where('tr_id',$id)->get();
        return response()->json([
            'status'=>200,
            'trainers'=>$trainers,
            'slots'=>$trainerSlot
        ],200);
    }
    public function tr_rating(Request $request){
        if($request->id !=""){
        if($request->rate !=""){
            $tr_rate=Trainer::where('tr_id',$request->id)->update([
                'stars'=>$request->rate
            ]);
            return response()->json([
                'status'=>200,
                'message'=>"Thanks for rating"
            ],200);
        }else{
            return response()->json([
                'status'=>403,
                'message'=>"please provide rating"
            ],403);
        }
    }else{
        return response()->json([
            'status'=>403,
            'message'=>"please provide Trainer ID"
        ],403);
    }
       
    }
    public function app_rating(Request $request){
        
        if($request->rate !=""){
            $tr_rate=AppRating::create([
                'stars'=>$request->rate
            ]);
            return response()->json([
                'status'=>200,
                'message'=>"Thanks for rating"
            ],200);
        }else{
            return response()->json([
                'status'=>403,
                'message'=>"please provide rating"
            ],403);
        }
    }
    public function all_trCalenderSlots(Request $request){
            if($request->date != ""){
                $tr_slots=TrainersSlot::where('tr_date',$request->date)->get();
                return response()->json([
                    'status'=>200,
                    'data'=>$tr_slots
                ]);
            }else{
                return response()->json([
                    'status'=>403,
                    'message'=>"Slot date should be provided"
                ],403);    
            }
            // $d1=$chat->created_at->format('l');
            // $d1=$chat->created_at->format('H:i:s');
            // $d1=$chat->created_at->format('d-m-Y');
       
    }
}
