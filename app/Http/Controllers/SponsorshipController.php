<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(House $house)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('sponsorship', [
            'token' => $token,
            'house' => $house,
        ]);
    }

    public function checkout(Request $request, $id)
    {

        
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            // qui possiamo salvare i dati dello user
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'email' => 'prova@prova.it',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        

        if ($result->success) {
            $transaction = $result->transaction;
            
            if($amount == 2.99){
                $sponsorshipId = 1;
            };
            if($amount == 5.99){
                $sponsorshipId = 2;
            };
            if($amount == 9.99){
                $sponsorshipId = 3;
            };

            $house = House::find($id);
            
            $house['sponsorship'] = true;
            $house->save();
            // dd($house['sponsorship']);

            $sponsorshipDate = $result->transaction->createdAt;
            

            $house->sponsorships()->attach([$sponsorshipId], ['created_at' => $sponsorshipDate]);
    
            return back()->with('success_message', 'Transazione avvenuta con successo. L\' ID è:' . ' ' . $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
