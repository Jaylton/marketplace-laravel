@extends('layouts.front')
@section('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h2>Dados para Pagamento</h2>
                <hr>
            </div>
        </div>
        <form action="">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nome no cartão </label>
                        <input type="text" name="card_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Número do cartão <span class="brand"></span></label>
                        <input type="text" name="card_number" class="form-control">
                        <input type="hidden" name="card_brand" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Mês de expiração</label>
                        <input type="text" name="card_month" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Ano de expiração</label>
                        <input type="text" name="card_year" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Código de segurança</label>
                        <input type="text" name="card_cvv" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 installments form-group">

                </div>
            </div>

            <button class="btn btn-success processCheckout">Realizar pagamento</button>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
{{-- <script src="{{asset('assets/js/jquery.ajax.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
</script>
<script>
    const sessionId = '{{session()->get("pagseguro_session_code")}}';
    PagSeguroDirectPayment.setSessionId(sessionId);
    let amountTransaction = '{{$total}}'
    let cardNumber = document.querySelector('input[name=card_number]');
    let spanBrand = document.querySelector('span.brand');
    cardNumber.addEventListener('keyup', function () {
        if(cardNumber.value.length >= 6){
            PagSeguroDirectPayment.getBrand({
                cardBin: cardNumber.value.substr(0, 6),
                success: function (res) {
                    let imgFlag = '<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/'+res.brand.name+'.png">';
                    spanBrand.innerHTML =  imgFlag;
                    document.querySelector('input[name=card_brand]').value = res.brand.name;
                    getInstallments(amountTransaction, res.brand.name);
                },
                error: function (erro) {
                    console.log(erro)
                },
                complete: function (res) {
                }
            })
        }
    });

    let submitButton = document.querySelector('button.processCheckout');

    submitButton.addEventListener('click', function (event) {
        event.preventDefault();
        PagSeguroDirectPayment.createCardToken({
            cardNumber: document.querySelector('input[name=card_number]').value,
            brand: document.querySelector('input[name=card_brand]').value,
            cvv: document.querySelector('input[name=card_cvv]').value,
            expirationMonth: document.querySelector('input[name=card_month]').value,
            expirationYear: document.querySelector('input[name=card_year]').value,
            success: function (params) {
                paymentProcess(params.card.token);
            }
        })
    })

    function paymentProcess(token) {
        let data = {
            card_token: token,
            _token: '{{csrf_token()}}',
            hash: PagSeguroDirectPayment.getSenderHash(),
            installment: document.querySelector('select.select_installment').value,
            card_name: document.querySelector('input[name=card_name]').value,
        }
        $.ajax({
            type: 'POST',
            url: '{{route("checkout.process")}}',
            data: data,
            dataType: 'json',
            success: function (res) {
                toastr.success(res.data.message, 'Sucesso');
                window.open('{{route("checkout.thanks")}}?order=' + res.data.order, '_self');
                window.location.href = '{{route("checkout.thanks")}}?order=' + res.data.order;
            }
        });
    }

    function getInstallments(amount, brand) {
        PagSeguroDirectPayment.getInstallments({
            amount: amount,
            brand: brand,
            maxInstallmentNoIntereset: 0,
            success: function (res) {
                console.log(res)
                let selectInstallments = drawSelectInstallments(res.installments[brand]);
                document.querySelector('div.installments').innerHTML = selectInstallments;
            },
            error: function (erro) {
                console.log(erro)
            },
        })
    }

    function drawSelectInstallments(installments) {
		let select = '<label>Opções de Parcelamento:</label>';

		select += '<select class="form-control select_installment">';

		for(let l of installments) {
		    select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
		}


		select += '</select>';

		return select;
	}

</script>
@endsection
