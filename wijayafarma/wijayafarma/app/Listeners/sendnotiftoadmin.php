<?php

namespace App\Listeners;

use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class sendnotiftoadmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function handle($event)
    {
        $admin = Order::whereHas('name',function($query){
            $query->where('id',1);
        })->get();
        Notification::send($admin,new OrderNotification ($event->order));
    }
}
