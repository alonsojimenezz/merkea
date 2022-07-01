<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderComplete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.completed', ['order' => $this->order, 'cart' => session('cart')])->subject(__('New order received #:order_id', ['order_id' => (str_pad(($this->order->Id ?? $this->order->id), 12, "0", STR_PAD_LEFT))]));
    }
}
