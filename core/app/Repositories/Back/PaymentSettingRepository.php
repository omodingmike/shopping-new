<?php

namespace App\Repositories\Back;

use App\{
    Helpers\ImageHelper,
    Models\PaymentSetting
};

class PaymentSettingRepository
{

    /**
     * Show the data for updating resource.
     *
     * @return \App\Models\PaymentSetting
     */
    public function payment()
    : PaymentSetting
    {
        return PaymentSetting::whereUniqueKeyword('mtn_mobile_money')->first();
    }

    /**
     * Update setting.
     *
     * @param  \App\Http\Requests\PaymentSettingRequest  $request
     * @return void
     */

    public function update($request)
    {

        $input = $request->all();
        $pay_data = PaymentSetting::whereUniqueKeyword($input['unique_keyword'])->first();

        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images',$pay_data,'/assets/images/','photo');
        }

        if($request->has('pkey')){

            $info_data = $input['pkey'];

            if($pay_data->unique_keyword == 'mollie'){
                $paydata = $pay_data->convertJsonData();
                $prev = $paydata['key'];
            }

            if (array_key_exists("check_sandbox",$info_data)){
                $info_data['check_sandbox'] = 1;
            }else{
                if (strpos($pay_data->information, 'check_sandbox') !== false) {
                    $info_data['check_sandbox'] = 0;
                }
            }

            $input['information'] = json_encode($info_data);

        }

        if($request->has('status')){
            $input['status'] = 1;
        }else{

            $input['status'] = 0;
        }
        // dd($input['pkey']['key']);
        $pay_data->update($input);

        if($pay_data->unique_keyword == 'mollie'){
            $paydata = $pay_data->convertJsonData();
            $this->setEnv('MOLLIE_KEY',$input['pkey']['key'],$prev);
        }
    }

    private function setEnv($key, $value,$prev)
    {

        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));

    }

}
