<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function chat_display(){

        $token= $_SERVER['HTTP_AUTHORIZATION'];
        if($token != ""){
            $user=User::where('token',$token)->first();
            if(isset($user->user_id)){
            $chat=Chat::where('user_token',$token)->orderBy('created_at')->get();
            // $d1=$chat->created_at->format('H:i a');
            // $d1=date('h:i A', strtotime($chat->created_at));
            if(!$chat->isEmpty()){
                return response()->json([
                    "status"=>200,
                    'data'=>$chat,
                    "message"=>"success"
                ],200);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"No results found"
                ],403);
            }
           
        }else{
            return response()->json([
                "status"=>403,
                "message"=>"Invalid Token"
            ],403);
        }
        }else{
            return response()->json([
                "status"=>403,
                "message"=>"Token should be provided"
            ],403);
        }   
    }
    public function msg_sent(Request $request){
        $token= $_SERVER['HTTP_AUTHORIZATION'];
        if($token != ""){
            $user=User::where('token',$token)->first();
            if(isset($user->user_id)){
            if($request->msg !=""){
                if($request->sender !=""){
                    $msg=Chat::create([
                        'message'=>$request->msg,
                        'sender'=>$request->sender,
                        'user_token'=>$token
                    ]);
                    return response()->json([
                        "status"=>403,
                        "message"=>"Message sent!"
                    ],403);
                }else{
                    return response()->json([
                        "status"=>403,
                        "message"=>"Sender type should be provided"
                    ],403);
                }
                }else{
                    return response()->json([
                        "status"=>403,
                        "message"=>"Message should be provided"
                    ],403);
            }
        }else{
            return response()->json([
                "status"=>403,
                "message"=>"Invalid Token"
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
