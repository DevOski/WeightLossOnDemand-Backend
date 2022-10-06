<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function signup(Request $request){
        if($request->first_name != ""){
            if($request->last_name != ""){
                if($request->email != ""){
                    if($request->password != ""){
                        if($request->gender != ""){
                            if($request->phone != ""){
                                if($request->phone_type != ""){
                                    if($request->dob != ""){
                                    if($request->fingerprint != ""){
                                        $pass=Hash::make($request->password);
                                        $token=Hash::make($request->email);
                                        $promo=random_int(01, 99);
                                        User::create([
                                            "first_name"=>$request->first_name,
                                            "middle_name"=>$request->middle_name,
                                            "last_name"=>$request->last_name,
                                            "email"=>$request->email,
                                            "password"=>$pass,
                                            "token"=>$token,
                                            "promo_code"=>$request->first_name.$promo,
                                            "gender"=>$request->gender,
                                            "prefix"=>$request->prefix,
                                            "suffix"=>$request->suffix,
                                            "phone"=>$request->phone,
                                            "phone_type"=>$request->phone_type,
                                            "date_of_birth"=>$request->dob,
                                            "fingerprint"=>$request->fingerprint,
                                        ]);
                                        // \Mail::send('email-template',)
                                        return response()->json([
                                            "status"=>200,
                                            "token"=>$token,
                                            "message"=>"Registration done successfully"
                                        ],200);

                                    }else{
                                        return response()->json([
                                            "status"=>403,
                                            "message"=>"Fingerprint value is required"
                                        ],403);
                                    }
                                    }else{
                                        return response()->json([
                                            "status"=>403,
                                            "message"=>"date of birth type is required"
                                        ],403);
                                    }
                                }else{
                                    return response()->json([
                                        "status"=>403,
                                        "message"=>"phone type is required"
                                    ],403);
                                }
                            }else{
                                return response()->json([
                                    "status"=>403,
                                    "message"=>"phone is required"
                                ],403);
                            }
                        }else{
                            return response()->json([
                                "status"=>403,
                                "message"=>"gender is required"
                            ],403);
                        }
                    }else{
                        return response()->json([
                            "status"=>403,
                            "message"=>"password is required"
                        ],403);
                    }
                }else{
                    return response()->json([
                        "status"=>403,
                        "message"=>"email is required"
                    ],403);
                }
              
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"lastname is required"
                ],403);
            }
        }else{
            return response()->json([
                "status"=>403,
                "message"=>"firstname is required"
            ],403);
        }
        //  $request->first_name

    }
    public function signin(Request $request){
        // $user=User::;
    }

    public function forgot_pass(){
       //Load Composer's autoloader
require 'PHPMailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'http://128.199.158.35:10000/';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'joynfuntogether';                     //SMTP username
    $mail->Password   = 'joynfuntogethergmail@123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('joynfuntogether@gmail.com', 'Mailer');
    $mail->addAddress('mustafailahi586@gmail.com', 'Joe User');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
public function user_details(){
    $token=$_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
        $user=User::where('token',$token)->first();
        return response()->json([
            "status"=>200,
            "data"=>$user,
            "message"=>"user found"
        ],200);
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}
public function update_username(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->fname !=""){
        if($request->lname !=""){
            $username=User::where('token',$token)->update([
                'first_name'=>$request->fname,
                'last_name'=>$request->lname
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Username has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
        }else{
         return response()->json([
             "status"=>403,
             "message"=>"Last name should be provided"
         ],403);
        }
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"First name should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}

public function update_email(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->email !=""){
            $username=User::where('token',$token)->update([
                'email'=>$request->email,
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Email has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Email should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}

public function update_phone(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->phone !=""){
            $username=User::where('token',$token)->update([
                'phone'=>$request->phone,
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Phone number has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Phone number should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}
public function update_address(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->address !=""){
       if($request->city !=""){
        if($request->state !=""){
            if($request->zipCode !=""){
                $username=User::where('token',$token)->update([
                    'address'=>$request->address,
                    'address2'=>$request->address2,
                    'city'=>$request->city,
                    'state'=>$request->state,
                    'zipcode'=>$request->zipCode,
                ]);
                if($username == 1){
                    return response()->json([
                        "status"=>200,
                        "message"=>"Address has been updated"
                    ]);
                }else{
                    return response()->json([
                        "status"=>403,
                        "message"=>"There is some problem while updating"
                    ],403);
                }
            }else{
             return response()->json([
                 "status"=>403,
                 "message"=>"Zip code should be provided"
             ],403);
            }
        }else{
         return response()->json([
             "status"=>403,
             "message"=>"state should be provided"
         ],403);
        }
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"city should be provided"
        ],403);
       }
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Address should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}
public function update_password(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->password !=""){
        $password=Hash::make($request->password);
            $username=User::where('token',$token)->update([
                'password'=>$password,
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Password has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Password should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}
public function update_fingrprnt(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->fingerprint !=""){
            $username=User::where('token',$token)->update([
                'fingerprint'=>$request->fingerprint,
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Fingerprint status has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Fingerprint status should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}
public function update_health_rec(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->health_rec !=""){
            $username=User::where('token',$token)->update([
                'health_records'=>$request->health_rec,
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Health record status has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Health record status should be provided"
        ],403);
       }
    }else{
        return response()->json([
            "status"=>403,
            "message"=>"Token should be provided"
        ],403);
    }
}
public function update_med_rec(Request $request){
    $token= $_SERVER['HTTP_AUTHORIZATION'];
    if($token != ""){
       if($request->med_rec !=""){
            $username=User::where('token',$token)->update([
                'med_records'=>$request->med_rec,
            ]);
            if($username == 1){
                return response()->json([
                    "status"=>200,
                    "message"=>"Status has been updated"
                ]);
            }else{
                return response()->json([
                    "status"=>403,
                    "message"=>"There is some problem while updating"
                ],403);
            }
           
       }else{
        return response()->json([
            "status"=>403,
            "message"=>"Status should be provided"
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
