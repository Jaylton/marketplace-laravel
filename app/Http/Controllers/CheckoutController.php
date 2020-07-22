<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Payment\PagSeguro\CreditCard;
Use App\Payment\PagSeguro\Notification;
use App\Store;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{

    public function index(){
        // session()->forget('pagseguro_session_code');
        if(!auth()->check()){
            return redirect()->route('login');
        }

        if(!session()->has('cart')){
            return redirect()->route('home');
        }

        $this->makePagSeguroSession();
        $total = 0;

        $cartItens = array_map(function($line){
            return $line['amount']*$line['price'];
        }, session()->get('cart'));
        $total = array_sum($cartItens);
        return view('checkout', compact('total'));
    }

    private function makePagSeguroSession(){
        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            session()->put('pagseguro_session_code',$sessionCode->getResult());
            return $sessionCode->getResult();
        }

    }

    public function process(Request $request){
        // try {

        $dataPost = $request->all();
        $user = auth()->user();
        $cartItens = session()->get('cart');

        $stores = array_unique(array_column($cartItens, 'store_id'));
        $reference = Uuid::uuid4();

        $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);
        $result = $creditCardPayment->doPayment();
        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'itens' => serialize($cartItens),
            'store_id' => 15
        ];
        $userOrder = $user->orders()->create($userOrder);
        $userOrder->stores()->sync($stores);

        session()->forget('cart');
        session()->forget('pagseguro_session_code');
        //notificar loja
        $store = (new Store())->notifyStoreOwners($stores);

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido enviado com sucesso!',
                'order' => $reference,
            ]
        ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'data' => [
        //             'status' => false,
        //             'message' => $e->getMessage(),
        //         ]
        //         ], 401);
        // }

    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        $notification = new Notification();
        $notification = $notification->getTransaction();
        $userOrder = UserOrder::whereReference($notification->getReference());
        $userOrder->update([
            'pagseguro_status' => $notification->getStatus(),
        ]);
        if($notification->getStatus() == 3){
            //confirmação do pagamento...
        }

        return response()->json([], 204);
    }
}
