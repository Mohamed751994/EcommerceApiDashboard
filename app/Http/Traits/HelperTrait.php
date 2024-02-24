<?php

namespace App\Http\Traits;

use App\Models\Industry;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

Trait HelperTrait
{
    public $paginate =   30;
    public $base_front_url = 'https://new.tamrah-one.com';

    //Success Response
    public function successResponse($message = '',$data = [],$statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    //Error Response
    public function errorResponse($message = '')
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }




    //Main Upload File Method
    public function uploadFileTrait($request, $fileInputName, $moveTo)
    {
        $file = $request->file($fileInputName);
        $fileUploaded='Upload_'.rand(1,99999999999).'.'.$file->getClientOriginalExtension();
        $file->move($moveTo, $fileUploaded);
        return $fileUploaded;
    }

    //Full image path
    public function image_full_path($image)
    {
        return asset('/uploads/'. $image);
    }

    //Delete File
    public function delete_file_before_delete_item($path)
    {
        $path = public_path($path);
        if (file_exists($path)) {
            File::delete($path);
        }
    }
    //return auth user id
    public function user_id()
    {
        return (Auth::check()) ? auth()->user()->id : null;
    }

    //Sendgrid api emails
    public function sendEmail($email, $name, $body, $subject)
    {

        $headers = array(
            'Authorization: Bearer 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' ,
            'Content-Type: application/json'
        );

        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $email,
                            "name" => $name
                        ),
                    )

                )
            ),
            "from" => array(
                "email" =>"mohamed.gamal@khomrigroup.com"
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            )
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    public function generateOrderRandomNumber() {
        $number = rand(11111111, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->OrderRandomNumberExists($number)) {
            return $this->generateOrderRandomNumber();
        }
        // otherwise, it's valid and can be used
        return $number;
    }

    public function OrderRandomNumberExists($number) {
        // query the database and return a boolean
        return Order::where('orderID',$number)->exists();
    }

    public function decreaseProductQty($pro, $qty)
    {
        return  ($pro->quantity >= $qty) ? Product::whereId($pro->id)->update(['quantity' => $pro->quantity - $qty]) : '';
    }



}

