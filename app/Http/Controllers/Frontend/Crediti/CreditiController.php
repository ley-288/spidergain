<?php

namespace App\Http\Controllers\Frontend\Crediti;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App\Crediti;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\App\Richiesta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class CreditiController extends Controller
{
     private $_api_context; 
     
     public function __construct(){
 
      
       
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
 
    }
 
    
   
    public function budget($user = false) {
        
       $id = ($user) ? $user : Auth::user()->id;
       $pacchetti = Crediti::where('user_id', $id)->get();
       
        $somma_pacchetti = $pacchetti->sum('pacchetto');
        
        $richieste = Richiesta::where('influencer_id', $id)->where('offerta_accettata', 1)->get();
        return ($somma_pacchetti) - (count($richieste));
        
    }
    
    public function crediti(){
        return view('frontend.crediti.index');
    }
    public function compra(Request $request){
         $validator = Validator::make($request->all(), [
           'crediti' => 'in:40,70,90'
       ]);
        
       if ($validator->fails()) {
            
            return redirect()->back()->with('flash_warning',__('applicazione.richiesta_non_valida'));
       }
       
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Crediti') 
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($request->get('crediti')); 

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($request->get('crediti'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription(__('applicazione.acquisto_crediti'));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('frontend.user.paymentstatus')) /** Specify return URL **/
            ->setCancelUrl(route('frontend.user.paymentstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

               
                return redirect()->route('frontend.user.paymentstatus')->with('flash_warning', 'Connection Timeout');

            } else {

                
                return redirect()->route('frontend.user.paymentstatus')->with('flash_warning',  __('applicazione_errore_sconosciuto'));

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        $amount_s = encrypt($request->get('crediti'));
        Session::put('amount', $amount_s);
        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

       
         return redirect()->route('frontend.user.paymentstatus')->with('flash_warning', __('applicazione.errore_sconosciuto'));

    }
    
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            
            return redirect()->route('frontend.user.crediti')->with('flash_warning',__('applicazione.pagamento_non_avvenuto'));
            

        }
        if(!isset($payment_id)){
          
           return redirect()->route('frontend.user.crediti')->with('flash_warning',__('applicazione.session_scaduta'));
          
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
          $crediti = new Crediti();
          $crediti->user_id = Auth::user()->id;
          $amount = decrypt(session('amount',0)); 
          switch($amount){
                  
              case 70:
                  $crediti->pacchetto = 20;
                  break;
              case 90:
                  $crediti->pacchetto = 30;
                  break;
              case 40:
                  $crediti->pacchetto = 10;
                  break;
              default:
                  $crediti->pacchetto = 0;
                  break;
          }
          $crediti->save();
          Session::forget('amount');
         // session(['flash_success' => __('applicazione.pagamento_avvenuto')]);
         return redirect()->route('frontend.user.crediti')->with('flash_success',__('applicazione.pagamento_avvenuto'));
          
        }
       // session(['flash_error' => __('applicazione.pagamento_non_avvenuto')]);
        return redirect()->route('frontend.user.crediti')->with('flash_error',__('applicazione.pagamento_non_avvenuto'));
    }
}
