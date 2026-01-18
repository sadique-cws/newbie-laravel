<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Show extends Component
{
    public Order $order;
    public $status;
    public $paymentStatus;

    public function mount(Order $order)
    {
        $this->order = $order->load(['items.variant.product', 'address', 'user']);
        $this->status = $order->status->value;
        $this->paymentStatus = $order->payment_status;
    }

    public function updateStatus()
    {
        $this->order->update(['status' => $this->status]);
        $this->dispatch('notify', 'Order status updated successfully.');
    }

    public function updatePaymentStatus()
    {
        $this->order->update(['payment_status' => $this->paymentStatus]);
        $this->dispatch('notify', 'Payment status updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.orders.show', [
            'statuses' => OrderStatus::cases(),
        ]);
    }
}
