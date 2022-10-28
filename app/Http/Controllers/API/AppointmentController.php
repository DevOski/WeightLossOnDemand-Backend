<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppRating;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment;


class AppointmentController extends Controller
{
    public function appointment(Request $request){
        $token= $_SERVER['HTTP_AUTHORIZATION'];
        if($token != ""){
            if($request->reason != ""){
                if($request->user_token){
                $apt_token= Hash::make($request->user_token);
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
                                                                    if($request->apt_time !=""){
                                                                        if($request->apt_day !=""){
                                                                            if($request->apt_date !=""){
                                                                                Appointment::create([
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
                                                                                    'apt_token'=>$apt_token,
                                                                                    'apt_time'=>$request->apt_time,
                                                                                    'apt_day'=>$request->apt_day,
                                                                                    'apt_date'=>$request->apt_date,
                                                                                 ]);
                                                                                 return response()->json([
                                                                                    'status'=>200,
                                                                                    'message'=>"Appointment created successfully"
                                                                                 ],200);
                                                                            }else{
                                                                            return response()->json([
                                                                                'status'=>403,
                                                                                'message'=>"Appointment date should be provided"
                                                                            ],403);
                                                                        }
                                                                        }else{
                                                                        return response()->json([
                                                                            'status'=>403,
                                                                            'message'=>"Appointment day should be provided"
                                                                        ],403);
                                                                    }
                                                                        
                                                                    }else{
                                                                        return response()->json([
                                                                            'status'=>403,
                                                                            'message'=>"Appointment time should be provided"
                                                                        ],403);
                                                                    }
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
                        'message'=>"User token can't be empty"
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
                "status"=>403,
                "message"=>"Token should be provided"
            ],403);
        }
    }
   

}
