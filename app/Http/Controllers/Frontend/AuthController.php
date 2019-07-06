<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\User;
use App\Notifications\RegistrationEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('frontend.auth.register');
    }

    public function processRegister()
    {
        //validation check
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:11|max:15|unique:users,phone_number',
            'password' => 'required|min:6'
        ]);
        //error message
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => request()->input('name'),
                'email' => strtolower(request()->input('email')),
                'phone_number' => request()->input('phone_number'),
                'password' => bcrypt(request()->input('password')),
                'email_verification_token' => uniqid(time(), true) . str_random(16),
            ]);


//notification call
//            $user->notify(new RegistrationEmailNotification($user));
            $this->setSuccess('Account Registered');

            return redirect()->route('login');
        } catch (\Exception $e) {
            $this->setError($e->getMessage());

            return redirect()->back();
        }
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function processLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->except(['_token']);
        if (auth()->attempt($credentials)) {
            return redirect('/');
        }
        $this->setError('Invalid credentials.');
        return redirect()->back();
        // use by notification login
//        $validator=Validator::make(request()->all(),[
//            'email'=>'required|email',
//            'password'=>'required'
//        ]);
//
//        if ($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInput();
//        }
//
//        $credentials=request()->only(['email','password']);
////if user return true
//        if (auth()->attempt($credentials)){
//            if(auth()->user()->email_verified_at===null){
//
//                $this->setError('your account in not activated');
//                return redirect()->route('login');
//            }
//            $this->setSuccess('User logged in.');
//
//            return redirect('/');
//        }
//
//        $this->setError('Invalid Credentials');
//
//        return redirect()->back();
    }


    //notification class
//    public function mail_activate($token = null)
//    {
//        if ($token === null){
//            return redirect('/');
//        }
//        $user=User::where('email_verification_token',$token)->firstOrFail();
//
//        if ($user){
//            $user->update([
//                'email_verified_at'=>Carbon::now(),
//                'email_verification_token'=>null,
//            ]);
//            $this->setSuccess('Account activated. You can login now');
//            return redirect()->route('login');
//        }
//        $this->setError('Invalid token');
//        return redirect()->route('login');
//    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    public function profile()
    {
        $data = [];
//user profile
        $data['orders'] = Order::where('user_id', auth()->user()->id)->get();
        return view('frontend.auth.profile',$data);
    }
}
