<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'title' => ['required', 'string', 'max:255'],
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'country_id' => ['required', 'string', 'max:255'],
        //     'work' => ['string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'user_name' => ['required', 'string', 'max:255'],
        //     'password' => ['required', 'string', 'min:8'],
        // ]);
        
        
         return Validator::make($data, [
            
            'firstName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'g-recaptcha-response'=>['required'],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        
        
        
          if(!empty($_POST['g-recaptcha-response'])){       
        $data_ = array(
            'secret' => "6LdrDu4UAAAAAPSCjiKNNtyi_M6DAJQ9L2A37GXC",
            'response' => $_POST['g-recaptcha-response']
        );        
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data_));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);       
        if($response == true){
           
            return User::create([
            
            'first_name' => $data['firstName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2
        ]);
            $result='<div class="success">Your request has been successfully received</div>';
            echo $result;
        }else{
            $result='<div class="error">Verification failed, please try again</div>';
            Session::flash('message', $result); 
        return redirect()->back();
        }
    }else{
         $result='<div class="error">Enter Capacha before login to system</div>';
            Session::flash('message', $result); 
        
        return redirect()->back();
    }
        
        
       
    }

    public function showRegistrationForm()
    {
        $countries = \App\Country::all();
        $data = [
            'countries' => $countries
        ];
        return view('auth.register')->with($data);
    }
}
