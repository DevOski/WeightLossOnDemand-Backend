<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Questionary;
use App\Models\Visit;
use App\Models\User;
use App\Models\Trainer;
use App\Models\VisitReason;
use Illuminate\Support\Facades\Hash;

class VisitController extends Controller
{
 public function reciept(){
    $data = [
        'title' => 'Welcome to ItSolutionStuff.com',
        'date' => date('m/d/Y')
    ];
      
    $pdf = PDF::loadHTML('<h1>full reciept</h1>');

    return $pdf->download('mustafa.pdf');
 }
 public function questionary(){
    $question=Questionary::get();
    return response()->json([
    'data'=>$question,
    ]);
 }
 public function question(Request $request){
    if($request->id != ""){
        $question=Questionary::where('q_id',$request->id)->get();
        return response()->json([
        'data'=>$question,
        ]);
    }else{
        return response()->json([
            'message'=>'ID should be provided'
        ]);
    }
    
 }

 public function create_visit(Request $request){
    if($request->user_token != ""){
    $visit_token= Hash::make($request->user_token);
    if($request->reason != ""){
        if($request->response_1 != ""){
            if($request->response_2 != ""){
                if($request->response_3 != ""){
                    if($request->response_4 != ""){
                        if($request->response_5 != ""){
                            if($request->trainer_id != ""){
                                if($request->tr_name !=""){
                                    if($request->habbit !=""){
                                        if($request->alergies !=""){
                                            if($request->medications !=""){
                                                if($request->medical_conditions !=""){
                                                    if($request->surgeries !=""){
                                                        Visit::create([
                                                            'user_token'=>$request->user_token,
                                                            'reason'=>$request->reason,
                                                            'response_1'=>$request->response_1,
                                                            'response_2'=>$request->response_2,
                                                            'response_3'=>$request->response_3,
                                                            'response_4'=>$request->response_4,
                                                            'response_5'=>$request->response_5,
                                                            'drugs_alergies'=>$request->alergies,
                                                            'medications'=>$request->medications,
                                                            'medical_conditions'=>$request->medical_conditions,
                                                            'surgeries'=>$request->surgeries,
                                                            'habbits'=>$request->habbit,
                                                            'trainer_id'=>$request->trainer_id,
                                                            'tr_name'=>$request->tr_name,
                                                            'visit_token'=>$visit_token,

                                                         ]);
                                                         return response()->json([
                                                            'status'=>200,
                                                            'message'=>"Visit created successfully"
                                                         ],200);
                                                    }else{
                                                        return response()->json([
                                                            'status'=>403,
                                                            'message'=>"surgeries can't be empty"
                                                        ],403);
                                                    }
                                                }else{
                                                    return response()->json([
                                                        'status'=>403,
                                                        'message'=>"medical condition should be provided"
                                                    ],403);
                                                }
                                            }else{
                                                return response()->json([
                                                    'status'=>403,
                                                    'message'=>"Medication should be provided"
                                                ],403);
                                            }
                                        }else{
                                        return response()->json([
                                            'status'=>403,
                                            'message'=>"alergies field is required"
                                        ],403);
                                        }
                                    }else{
                                        return response()->json([
                                            'status'=>403,
                                            'message'=>"habbits are required"
                                        ],403);
                                    }
                                    
                                }else{
                                    return response()->json([
                                        'status'=>403,
                                        'message'=>"Please provide Trainer name"
                                    ]);
                                }
                            }else{
                                return response()->json([
                                    'status'=>403,
                                    'message'=>"Please provide Trainer ID"
                                ]);
                            }
                           
                        }else{
                            return response()->json([
                                'status'=>403,
                                'message'=>"Please provide response 5"
                            ]);
                        }
            
                    }else{
                        return response()->json([
                            'status'=>403,
                            'message'=>"Please provide response 4"
                        ]);
                    }
                }else{
                    return response()->json([
                        'status'=>403,
                        'message'=>"Please provide response 3"
                    ]);
                }
                    }else{
                        return response()->json([
                            'status'=>403,
                            'message'=>"Please provide response 2"
                        ]);
                    }
            
        }else{
            return response()->json([
                'status'=>403,
                'message'=>"Please provide response 1"
            ]);
        }
    }else{
        return response()->json([
            'status'=>403,
            'message'=>"Please provide visit reason"
        ],403);
    }
    }else{
        return response()->json([
            'status'=>403,
            'message'=>"User token can't be empty"
        ]);
    }
    
}
      
 
 public function visit_reason(){
    $reason=VisitReason::get();
    return response()->json([
        'status'=>200,
        'data'=>$reason,
    ]);

 }
 public function search_reason(Request $request){
    $reason=VisitReason::where('vr_opts','LIKE','%'.$request->param.'%')->get();
    return response()->json([
        'status'=>200,
        'data'=>$reason,
    ]);
 }
 public function past_visit(){
    $token=$_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
        $user=User::where('token', $token)->first();
        if(isset($user->user_id)){
            $details=Visit::where('user_token',$token)->orderBy('created_at','DESC')->first();
            $trainer=Trainer::where('tr_id',$details->trainer_id)->get();
            return response()->json([
                'status'=>200,
                'visit'=>$details,
                'trainer'=>$trainer,
                'user'=>$user
            ]);
        }else{
            return response()->json([
                'status'=>403,
                'message'=>'Invalid token',
            ],403);
        }
       
    }else{
        return response()->json([
            'status'=>403,
            'message'=>'token should be provided',
        ],403);
    }
  
 }
public function visit_details(){
    $details=Visit::where('')->get();
}
}
