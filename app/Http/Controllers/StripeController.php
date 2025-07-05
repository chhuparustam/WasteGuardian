<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Activity;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\TextMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class StripeController extends Controller
{
    public function checkout($id)
    {
        if(!Auth::check() || !$id) {
        return redirect()->route('login')->with('error', 'You must be logged in to delete a request.');
        }

        $service = ServiceBooking::with('cleaningService')->find($id);
        Session::put('payment_service_id', $id);
        return view('stripe.checkout', compact('service'));
    }

    public function charge(Request $request)
    {
        // dd($request->all());
        $id = $request->service_id;    
        if(!Auth::check() || !$id) {
        return redirect()->route('login')->with('error', 'You must be logged in to delete a request.');
        }
        $service =  ServiceBooking::with('cleaningService')->find($id);
        if($service){
            Stripe::setApiKey(config('services.stripe.secret'));

            try {
              $data =   [
                'amount' => $request->amount * 100, // $10.00
                'currency' => 'usd',
                'source' =>$request->stripeToken,
                'description' => 'Test charge from Laravel app',
              ];
            //   dd($data);
          $charge =   Charge::create($data);

            if($charge){
                $service->where('id',$id)->update(['payment_status' =>'Paid','ref_id' => rand(10,11111111111111),'status'=>'Approved']);
                Activity::create([
                    'user_id' => Auth::id(),
                    'description' => 'Payment Done for  ' . $service->cleaningService->title,
                    'type' => 'service_booking',
                ]);

                $user =  User::find(Auth::id());
                Mail::raw("Your payment is done. Please contact us for further details.", function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Payment Notice');
                    });
                
            }

           return redirect()->route('user.services.booked')->with('success', 'Payment success!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        }

        return redirect()->route('user.services.booked')->with('error', 'Something went wrong!');
        
        
    }
}
