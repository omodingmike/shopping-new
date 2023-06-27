<!-- Modal Cash on Transfer-->
<div class="modal fade" id="cod" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{__('Pay Cash On Delivery')}}</h6>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('front.checkout.submit')}}" method="POST">
                @csrf
                <input type="hidden" name="payment_method" value="Cash On Delivery" id="">
                <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}"
                       class="state_id_setup">
                <div class="card-body">
                    <p>{{PriceHelper::GatewayText('cod')}}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
                    <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Cash On Delivery')}}</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Airtel -->

@foreach(\App\Models\PaymentSetting::where('status',1)->get() as $payment_gateway)
    <div class="modal fade" id="{{$payment_gateway->unique_keyword}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @php
                        $name=$payment_gateway->name;
                    @endphp
                    <h6 class="modal-title">Pay via {{$name}}</h6>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="card-wrapper"></div>
                        <form class="interactive-credit-card row" action="{{route('front.checkout.submit')}}" method="POST">
                            @csrf
                            <div class="form-group col-sm-12">
                                <input class="form-control" type="text" name="phone" placeholder="{{ __('Phone Number e.g 07xxxxxxxx') }}"
                                       required >
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal"><span>{{ __('Cancel') }}</span></button>
                    <button class="btn btn-primary btn-sm" type="submit"><span>{{__('Chekout With Stripe')}}</span></button>
                </div>
            </div>
        </div>
    </div>
@endforeach
