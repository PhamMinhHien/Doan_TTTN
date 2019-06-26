<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email_Receive;
use App\Http\Requests\EmailReceiveRequest;
use App\Classes\ActivationService;
use Validator;
use Illuminate\Support\MessageBag;

class EmailReceiveController extends Controller
{

  protected $activationService;

  // Tạo đối tượng chứa tham số đối tượng khác -- khởi tạo nó với cái 
  public function __construct(ActivationService $activationService)
  {
    $this->activationService = $activationService;
  }


  // Hàm tạo đối tượng Email với dữ liệu mảng vào
  protected function create(array $data)
  {
    return Email_Receive::create([
      'name' => $data['name']
    ]);
  }

  // add email + gửi tin xác nhận 
  public function send(Request $request)
  {
    // Gọi request 
    $emailreceiverequest = new EmailReceiveRequest();
    $validator = Validator::make($request->all(), $emailreceiverequest->rules(), $emailreceiverequest->messages());
    if ($validator->fails()) 
    {
      return redirect()->back()->withErrors($validator)->withInput();
    } 
    else 
    {
      // Kiểm tra email có tồn tại hay ko 
      $email = new Email_Receive();
      $check_email = $email->getEmail_checkRegister($request->input('email'));
      // Nếu ko tồn tại 
      if($check_email->count() == 0)
      {
        $email->email = $request->input('email');
        $email->save();
        // Gửi mail xác nhận đến địa chỉ email này 
        // cái này là thuộc tính 
        $this->activationService->sendActivationMail($email);
        return redirect()->back()->with('alert', 'Bạn hãy kiểm tra email và thực hiện xác thực theo hướng dẫn.');
      }
      else
      {
        $msg = new MessageBag(['errlogin'=> 'Email đã tồn tại ! Vui lòng kiểm tra lại !']);
        return redirect()->back()->withErrors($msg);
      }
    }
  }

  // ĐƯờng dẫn xác nhận email 
  public function activateUser($token)
  {
    if ($user = $this->activationService->activateUser($token)) {
      return redirect()->route('home-page')->with('alert', 'Xác thực email thành công !');
    }
    abort(404);
  }
  
}
