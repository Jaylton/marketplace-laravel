<?php
    namespace App\Payment\PagSeguro;

    class CreditCard{
        private $itens;
        private $user;
        private $cardInfo;
        private $reference;

        public function __construct($itens, $user, $cardInfo, $reference){
            $this->itens = $itens;
            $this->user = $user;
            $this->cardInfo = $cardInfo;
            $this->reference = $reference;
        }

        public function doPayment(){

            $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

            $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

            $creditCard->setReference($this->reference);

            $creditCard->setCurrency("BRL");

            foreach($this->itens as $item){
                $creditCard->addItems()->withParameters(
                    $this->reference,
                    $item['name'],
                    $item['amount'],
                    $item['price']
                );
            }

            $user = $this->user;
            $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;
            // Set your customer information.
            // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
            $creditCard->setSender()->setName($user->name);
            $creditCard->setSender()->setEmail($email);

            $creditCard->setSender()->setPhone()->withParameters(
                11,
                56273440
            );

            $creditCard->setSender()->setDocument()->withParameters(
                'CPF',
                '74786502014'
            );

            $creditCard->setSender()->setHash($this->cardInfo['hash']);

            $creditCard->setSender()->setIp('127.0.0.0');

            // Set shipping information for this payment request
            $creditCard->setShipping()->setAddress()->withParameters(
                'Av. Brig. Faria Lima',
                '1384',
                'Jardim Paulistano',
                '01452002',
                'São Paulo',
                'SP',
                'BRA',
                'apto. 114'
            );

            //Set billing information for credit card
            $creditCard->setBilling()->setAddress()->withParameters(
                'Av. Brig. Faria Lima',
                '1384',
                'Jardim Paulistano',
                '01452002',
                'São Paulo',
                'SP',
                'BRA',
                'apto. 114'
            );

            // Set credit card token
            $creditCard->setToken($this->cardInfo['card_token']);

            list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);
            $installmentAmount = number_format($installmentAmount, 2, '.', ',');
            $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

            // Set the credit card holder information
            $creditCard->setHolder()->setBirthdate('01/10/1979');
            $creditCard->setHolder()->setName($this->cardInfo['card_name']); // Equals in Credit Card

            $creditCard->setHolder()->setPhone()->withParameters(
                11,
                56273440
            );

            $creditCard->setHolder()->setDocument()->withParameters(
                'CPF',
                '74786502014'
            );

            $creditCard->setMode('DEFAULT');

            $result = $creditCard->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            return $result;
        }
    }


