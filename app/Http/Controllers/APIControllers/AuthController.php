<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Requests\AddUpdateAddressRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Traits\HelperTrait;
use App\Models\Reset;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use HelperTrait;

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['type'] = 2;
            $user = User::create($data);
            //Send Mail to Vendor
            $link =  $this->base_front_url.'/verification-email/'.Crypt::encryptString($user->id);
            $html = view('emails.verification_email', compact('user', 'link'))->render();
            $this->sendEmail($user->email,__('text.websiteName'),$html, __('text.verificationEmail'));
            DB::commit();
            return $this->successResponse(
                __('text.verificationEmailSent')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse($th->getMessage());
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = User::whereId($this->user_id())->first();
                if(!auth()->user()->email_verified_at)
                {
                    return $this->errorResponse(__('text.notVerificationEmail'));
                }
                if(auth()->user()->active == 0)
                {
                    return $this->errorResponse(__('text.AccountDeactivation'));
                }
                return $this->successResponse(
                    __('text.successLogin'),
                    ['access_token' =>auth()->user()->createToken("LOGIN TOKEN")->plainTextToken , 'user' => $user]
                );
            }
            return $this->errorResponse(__('text.LoginError'));

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successResponse(__('text.LogoutOut'));
    }


    public function forget_password(ForgetPasswordRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::whereEmail($data['email'])->first();
            if (!$user) {
                return $this->errorResponse(__('text.emailNotFound'));
            }
            //Send Email Here
            $encrypt = Crypt::encryptString($user->id);
            $link =  $this->base_front_url.'/reset-password/'.$encrypt;
            $html = view('emails.forget_password', compact('user', 'link'))->render();
            $this->sendEmail($user->email,__('text.websiteName'),$html, __('text.resetPassword'));
            return $this->successResponse(__('text.emailSent'), []);

        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function reset_password(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $user = User::whereId(Crypt::decryptString($data['encrypt_user_id']))->first();
            if(Reset::whereEmail($user->email)->whereToken($data['encrypt_user_id'])->exists())
            {
                return $this->errorResponse(__('text.passwordChangedThroughThisLinkBefore'));
            }
            if ($user) {
                $user->update(['password' => $data['password']]);
                Reset::create([
                    'email' =>$user->email,
                    'token' =>$data['encrypt_user_id'],
                    'expire_date' =>date("Y-m-d", strtotime('+ 1' , strtotime(date("Y-m-d"))))
                ]);
                DB::commit();
                return $this->successResponse(__('text.passwordChanged'), []);
            } else {
                return $this->errorResponse(__('text.error'));
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorResponse($th->getMessage());
        }
    }

    //Verification Email
    public function verification_email($id)
    {
        $user = User::find(Crypt::decryptString($id));
        if($user && is_null($user->email_verified_at))
        {
            $user->update(['email_verified_at' =>date('Y-m-d H:i:s')]);
            $message = __('text.emailVerifiedLoginNow');
        }
        else
        {
            $message = __('text.emailVerifiedAlreadyLoginNow');
        }
        return $this->successResponse($message);
    }


    //get_user
    public function get_user()
    {
        return $this->successResponse(__('text.successTrue'), auth()->user());
    }

    //profile
    public function profile(UserProfileRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $image = $this->uploadFileTrait($request,'image', 'uploads/');
                $data['image'] = $image;
            }
            auth()->user()->update($data);
            return $this->successResponse(__('text.successMessage'));
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            auth()->user()->update(['password' => $data['password']]);
            DB::commit();
            return $this->successResponse(__('text.passwordChanged'), []);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorResponse($th->getMessage());
        }
    }



    //deactivate
    public function deactivation(Request $request)
    {
        auth()->user()->update(['active'=>0]);
        $request->user()->tokens()->delete();
        return $this->successResponse(__('text.AccountDeactivationMsg'));
    }

    //get_user_address
    public function get_user_address()
    {
        return $this->successResponse(__('text.successTrue'), auth()->user()->address);
    }

    //add_or_update_User_Address
    public function add_or_update_address(AddUpdateAddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->user_id();
        UserAddress::updateOrCreate(['id' => $request->get('address_id')],$data);
        return $this->successResponse(__('text.successUpdate'), []);
    }


}
