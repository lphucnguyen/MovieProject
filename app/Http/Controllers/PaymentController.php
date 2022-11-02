<?php

namespace App\Http\Controllers;

use App\Jobs\SendPaymentEmail;
use App\Membership;
use App\Transaction;
use App\User;

use Carbon\Carbon;
use App\Services\PaymentService\FactoryPaymentService;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Service\PaymentService\MoMoService;
use App\Services\PaymentService\Entities\EntityProcess;
use App\Services\PaymentService\Entities\EntityTransaction;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $MOMO_LIMITED = 10000;

    public function processPayment(Request $request) {
        $attributes = $request->validate([
            'idMembership' => ['required', 'exists:memberships,id'],
            'payment' => 'required|string',
            'idUser' => ['required', 'exists:users,id'],
        ]);
        $basicMembership = config('membership');
        $user = auth()->guard('web')->user();
        $membership = Membership::findOrFail($attributes['idMembership']);
        $isPast = Carbon::parse($user->expired_at)->isPast();

        if($membership->membership_id == $basicMembership['id']){
            return redirect('/');
        }

        if($isPast){
            $amount = $membership->price;
        }else{
            $daysUsed = now()->diffInDays(Carbon::parse($user->expired_at));
            $amount = ($membership->price - $daysUsed*$user->membership->price > $this->MOMO_LIMITED) ? $membership->price - $daysUsed*$user->membership->price : $this->MOMO_LIMITED;
        }

        $paymentService = FactoryPaymentService::createPaymentService($attributes['payment'])
                                ->get();

        $entityProcess = new EntityProcess();
        $entityProcess->idUser = $attributes['idUser'];
        $entityProcess->amount = $amount;
        $entityProcess->idMembership = $attributes['idMembership'];
        
        $response = $paymentService->process($entityProcess);
        
        if($response['payUrl']){
            return redirect()->to($response['payUrl']);
        }

        return redirect('/');
    }

    public function processMoMoSuccessfully($encryptedInformation, Request $request) {
        $encryptedInformation = decrypt($encryptedInformation);
        
        $user = User::findOrFail($encryptedInformation['idUser']);
        if(!$user) redirect('/');

        $attributes = $request->validate([
            'partnerCode' => 'required',
            'resultCode' => 'required|string',
            'transId' => 'required',
            'orderId' => 'required'
        ]);

        if($attributes['resultCode'] == 0){
            $entityTransaction = new EntityTransaction();
            $entityTransaction->requestId = $request->get('requestId');
            $entityTransaction->orderId = $request->get('orderId');

            $paymentService = FactoryPaymentService::createPaymentService($encryptedInformation['payment'])
                                ->get();

            $response = $paymentService->statusTransaction($entityTransaction);

            if($response['message'] !== 'Success') return;

            $transaction = Transaction::create([
                'user_id' => (int)$encryptedInformation['idUser'],
                'membership_id' => (int)$encryptedInformation['idMembership'],
                'trans_id' => $attributes['transId'],
                'method_payment' => 'momo',
                'expired_at' => Carbon::now()->addMonth(1)->toDateTimeString(),
            ]);

            $user->membership_id = $encryptedInformation['idMembership'];
            $user->expired_at = Carbon::now()->addMonth(1)->toDateTimeString();
            $user->save();

            $emailPaymentJob = new SendPaymentEmail(
                $emailContent = [
                    'email' => $user->email,
                    'title' => 'Hoá đơn thanh toán'
                ],
                $transaction
            );
            dispatch($emailPaymentJob);
        }

        return redirect('user/profile');
    }

    public function processVNPaySuccessfully($encryptedInformation, Request $request) {
        $encryptedInformation = unserialize(base64_decode($encryptedInformation));
        
        $user = User::findOrFail($encryptedInformation['idUser']);

        if(!$user) redirect('/');

        $attributes = $request->validate([
            'vnp_SecureHash' => 'required',
            'vnp_TransactionNo' => 'required|string',
            'vnp_ResponseCode' => 'required',
            'vnp_BankTranNo' => 'required'
        ]);

        if($attributes['vnp_ResponseCode'] === '00'){
            $entityTransaction = new EntityTransaction();
            $entityTransaction->vnp_SecureHash = $request->get('vnp_SecureHash');
            $entityTransaction->attributes = $request->all();

            $paymentService = FactoryPaymentService::createPaymentService($encryptedInformation['payment'])
                                                        ->get();

            $response = $paymentService->statusTransaction($entityTransaction);

            if($response['code'] !== 0) return;

            $transaction = Transaction::create([
                'user_id' => (int)$encryptedInformation['idUser'],
                'membership_id' => (int)$encryptedInformation['idMembership'],
                'trans_id' => $attributes['vnp_BankTranNo'],
                'method_payment' => 'vnpay',
                'expired_at' => Carbon::now()->addMonth(1)->toDateTimeString(),
            ]);

            $user->membership_id = $encryptedInformation['idMembership'];
            $user->expired_at = Carbon::now()->addMonth(1)->toDateTimeString();
            $user->save();

            $emailPaymentJob = new SendPaymentEmail(
                $emailContent = [
                    'email' => $user->email,
                    'title' => 'Hoá đơn thanh toán'
                ],
                $transaction
            );
            dispatch($emailPaymentJob);
        }

        return redirect('user/profile');
    }
}
