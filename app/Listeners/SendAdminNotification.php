<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class SendAdminNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewOrderEvent $event): void
    {
        $order = $event->order;

        $message = "มีคำสั่งซื้อใหม่!\n";
        $message .= "รหัสคำสั่ง: {$order->id}\n";
        $message .= "ลูกค้า: {$order->email}\n";
        $message .= "ราคารวม: {$order->summary_price} บาท\n";

        $response = Http::post('https://notify-api.line.me/api/notify', [
            'message' => $message,
        ])->withHeaders([
            'Authorization' => 'Bearer YOUR_LINE_NOTIFY_ACCESS_TOKEN',
        ]);

        /*
            ส่ง Line SMS EMAIL ไปหา ADMIN เจ้าของ บ.
        */
    }
}
