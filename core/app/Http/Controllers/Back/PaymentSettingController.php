<?php

    namespace App\Http\Controllers\Back;

    use App\{
        Models\PaymentSetting,
        Http\Controllers\Controller,
        Http\Requests\PaymentSettingRequest,
        Repositories\Back\PaymentSettingRepository
    };

    use Illuminate\Http\Request;

    class PaymentSettingController extends Controller
    {
        /**
         * Constructor Method.
         *
         * Setting Authentication
         *
         * @param \App\Repositories\Back\PaymentSettingRepository $repository
         *
         */
        public function __construct(PaymentSettingRepository $repository)
        {
            $this->middleware('auth:admin');
            $this->middleware('adminlocalize');
            $this->repository = $repository;
        }

        /**
         * Show the form for updating resource.
         *
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function payment()
        {
            $payment_gateways = PaymentSetting::all();
            return view('back.settings.payment', compact($payment_gateways, 'payment_gateways'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function update(PaymentSettingRequest $request)
        {
            $this->repository->update($request);
            return redirect()->back()->withSuccess(__('Payment Information Updated Successfully.'));
        }

    }
