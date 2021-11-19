<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class LoginController extends Controller
{
    public function register()
    {

        return view('register');
    }

    public function handleRegister(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',

        ]);

        $data = $request->all();
        $this->handleCreateUser($data);


        Alert::success('Register Successfully', 'Please Confirm Email First');
        $request->session()->put('email', $request->email);
        return redirect("confirm-email");
    }

    private function handleCreateUser($data)
    {
       

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function login()
    {

        return view('login');
    }

    public function handleLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');                
        } else {

            Alert::error('Login Failed', 'Wrong combination of name and password');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');


    }

    public function emailConfirmation(){
        return view('confirm-email');
    }

    public function sendEmail(Request $request){
        $token = Hash::make(session('email'));
        $token = str_replace("/",'',$token);
        $request->session()->put('token', $token);
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);
        try {

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'confirmemail554';   //  sender username
            $mail->Password = 'Confirm12345678';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom('confirmemail554@gmail.com', 'confirmemail554');
            $mail->addAddress(session(('email')));
           

            $mail->addReplyTo('confirmemail554@gmail.com', 'confirmemail554');

            


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = 'confirm email';
            $mail->Body    = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>
                    body {
                        padding: 0;
                        margin: 0;
                    }
            
                    .container {
                        display: flex;
                        justify-content: center;
                        width: 100vw;
                        height: 100vh;
                        background-color: #3D4148;
                    }
            
                    .wrapper {
                        position: relative;
                        top: 100px;
                        background-color: white;
                        flex-direction: column;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-sizing: border-box;
                        padding: 20px;
                        width: 80%;
                        height: 200px;
                        border: 2px solid black;
                        border-radius: 10px;
                    }
            
                    button {
                        width: 150px;
                        height: 50px;
                        background-color: #2EFF69;
                        color: white;
                        font-weight: bold;
                        font-size: 20px;
                        border: none;
                    }
            
                </style>
            </head>
            
            <body>
                <div class="container">
                    <div class="wrapper">
                        <h1>Click here to verify </h1>
                       
                          
                            <button ><a href="http://127.0.0.1:8002/handle-confirm-email/'.  $token .'">confirm</a></button>
                       
                    </div>
                </div>
            
            </body>
            
            </html>
            ';

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                dd($mail->ErrorInfo);
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return redirect('success-send-email');
            }

        } catch (Exception $e) {
            dd($e);
             return back()->with('error','Message could not be sent.');
        }

    }

    public function sendEmailSuccess()
    {
        return view('send-email-success');
    }

    public function handleConfirmEmail($token)
    {
        
        $user = User::where(['email' => session('email')])->first();
      
        if(Hash::check(session('email'),$token)){

            Alert::success('Confirm Email Successfully', 'Please Login First');
           $user->email_verified_at = date("Y-m-d H:i:s");
           $user->save();
            return redirect("login");
        } else {
            Alert::error('Confirm Email Fail', 'Please Try Again');
           
            return redirect("confirm-email");
        }
    }
}
