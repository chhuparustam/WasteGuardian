<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\TextMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\ServiceBooking;
class KhaltiController extends Controller
{
    public function init(){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://dev.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "return_url": "http://rustam.test/khalti-check",
    "website_url": "http://rustam.test",
    "amount": "1000",
    "purchase_order_id": "Order01",
        "purchase_order_name": "test",

    "customer_info": {
        "name": "Test Bahadur",
        "email": "test@khalti.com",
        "phone": "9800000001"
    }
    }

    ',
    CURLOPT_HTTPHEADER => array(
        'Authorization: key ce28912bbc65490da156aad616cdc747',
        'Content-Type: application/json',
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    }

    public function check(Request $request){
        $data = $request->all();
        $id =Session::get('payment_service_id') ;    
        if(!Auth::check() || !$id) {
        return redirect()->route('login')->with('error', 'You must be logged in to delete a request.');
        }
        $service =  ServiceBooking::with('cleaningService')->find($id);

                 
    if (isset($data['status']) && $data['status'] === 'Completed') {
        $service->where('id',$id)->update(['payment_status' =>'Paid','ref_id' => rand(10,11111111111111),'status'=>'Approved']);
        $user =  User::find(Auth::id());
                Mail::raw("Your payment is done. Please contact us for further details.", function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Payment Notice');
                    });

        return redirect()->route('user.services.booked')->with('success', 'Payment success!');   
    } else {
       
        return redirect()->route('payment.failed');
    }

    }

    // http://rustam.test/khalti-check?pidx=auzfysMhPwBzGBPiynQKBm&transaction_id=QYMp2nz5ZWbeZ6dPzXwNFk&tidx=QYMp2nz5ZWbeZ6dPzXwNFk&txnId=QYMp2nz5ZWbeZ6dPzXwNFk&amount=1000&total_amount=1000&mobile=98XXXXX005&status=Completed&purchase_order_id=Order01&purchase_order_name=test
}
