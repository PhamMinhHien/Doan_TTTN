<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        // Khởi tạo http Client 
        $client = new Client();
        //Gửi dữ liệu đến google recaptcha xử lý
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6LfptKgUAAAAAC4giEaIFaOl5SriQgFzBbfZ0iFU',
                    'response'=>$value
                 ]
            ]
        );
        // Google reCaptcha trả về kết quả đúng/sai
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

}
