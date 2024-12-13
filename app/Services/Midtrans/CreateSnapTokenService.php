<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order_data;

    public function __construct($order)
    {
        parent::__construct();

        $this->order_data = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order_data['order_number'],
                'gross_amount' => $this->order_data['total_amount'],
            ],
            'customer_details' => [
                'first_name' => $this->order_data['first_name'],
                'last_name' => $this->order_data['last_name'],
                'email' => $this->order_data['email'],
                'phone' => $this->order_data['phone'],
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
