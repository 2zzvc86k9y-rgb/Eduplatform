<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class TMoneyController extends Controller
{
    public function processPayment(Request $request)
    {
        \Log::info('Début du processus de paiement TMoney', $request->all());

        // Validation des données
        try {
            $request->validate([
                'name' => 'required',
                'tmoney_number' => 'required|numeric',
                'email' => 'required|email',
                'total' => 'required|numeric'
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur de validation TMoney: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Veuillez vérifier tous les champs requis'
            ]);
        }

        try {
            // Récupération des données du panier
            $carts = Cart::content();
            $cartTotal = Cart::total();

            \Log::info('Données du panier TMoney', [
                'total' => $cartTotal,
                'items' => $carts->count()
            ]);

            // Création de la commande
            $order = new Order();
            $order->user_id = Auth::id();
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->tmoney_number;
            $order->payment_type = 'TMoney';
            $order->payment_method = 'TMoney';
            $order->transaction_id = uniqid();
            $order->currency = 'XOF';
            $order->amount = $cartTotal;
            $order->order_number = uniqid();
            $order->invoice_no = 'EDU'.mt_rand(10000000,99999999);
            $order->order_date = date('Y-m-d');
            $order->order_month = date('F');
            $order->order_year = date('Y');
            $order->status = 'pending';
            $order->save();

            \Log::info('Commande TMoney créée', ['order_id' => $order->id]);

            // Ajout des éléments de la commande
            foreach($carts as $cart) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->course_id = $cart->id;
                $orderItem->instructor_id = $cart->options->instructor_id;
                $orderItem->price = $cart->price;
                $orderItem->save();
            }

            // Initialisation de la transaction TMoney
            $tmoneyResponse = $this->initiateTMoneyPayment([
                'amount' => $cartTotal,
                'phone' => $request->tmoney_number,
                'order_id' => $order->id,
                'description' => 'Paiement de cours sur EduPlatform'
            ]);

            \Log::info('Réponse TMoney', $tmoneyResponse);

            if($tmoneyResponse['success']) {
                // Vider le panier
                Cart::destroy();
                
                // Supprimer le coupon s'il existe
                if(Session::has('cupon')) {
                    Session::forget('cupon');
                }

                return response()->json([
                    'success' => true,
                    'redirect_url' => $tmoneyResponse['payment_url']
                ]);
            } else {
                \Log::error('Échec de l\'initialisation du paiement TMoney', $tmoneyResponse);
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de l\'initialisation du paiement TMoney'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Erreur lors du processus de paiement TMoney: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du traitement de votre paiement'
            ]);
        }
    }

    private function initiateTMoneyPayment($data)
    {
        $environment = config('services.tmoney.environment');
        $baseUrl = $environment === 'sandbox' 
            ? config('services.tmoney.sandbox_url')
            : config('services.tmoney.production_url');

        $apiUrl = $baseUrl . '/payment/initiate';
        
        $payload = [
            'merchant_id' => config('services.tmoney.merchant_id'),
            'api_key' => config('services.tmoney.api_key'),
            'amount' => $data['amount'],
            'phone' => $data['phone'],
            'order_id' => $data['order_id'],
            'description' => $data['description'],
            'callback_url' => config('services.tmoney.callback_url'),
            'timestamp' => time(),
        ];

        // Génération de la signature pour l'environnement de test
        $signature = hash_hmac('sha256', json_encode($payload), config('services.tmoney.api_secret'));
        $payload['signature'] = $signature;

        // En environnement de test, nous simulons une réponse réussie
        if ($environment === 'sandbox') {
            return [
                'success' => true,
                'payment_url' => $baseUrl . '/checkout/' . uniqid(),
                'transaction_id' => 'TEST-' . uniqid(),
                'status' => 'pending'
            ];
        }

        // Pour la production, nous ferons l'appel API réel
        $client = new Client();
        try {
            $response = $client->post($apiUrl, [
                'json' => $payload,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);

            $result = json_decode($response->getBody(), true);
            return [
                'success' => true,
                'payment_url' => $result['payment_url'],
                'transaction_id' => $result['transaction_id'],
                'status' => $result['status']
            ];
        } catch (\Exception $e) {
            \Log::error('TMoney API Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Erreur lors de l\'initialisation du paiement TMoney'
            ];
        }
    }

    public function handleCallback(Request $request)
    {
        // Traitement de la réponse de TMoney
        $orderId = $request->order_id;
        $status = $request->status;
        
        $order = Order::findOrFail($orderId);
        
        if($status === 'success') {
            $order->status = 'complete';
            $order->save();
            
            // Envoyer une notification à l'utilisateur
            // Envoyer un email de confirmation
            // etc.
            
            return redirect()->route('payment.success')->with('success', 'Paiement effectué avec succès');
        } else {
            $order->status = 'failed';
            $order->save();
            
            return redirect()->route('payment.failed')->with('error', 'Le paiement a échoué');
        }
    }
} 