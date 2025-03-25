<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class CancelOrderJob implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * 建構子，接收要取消的訂單
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * 執行 Job
     */
    public function handle()
    {
        if ($this->order->status === 'unpaid') {
            // 更新訂單狀態為已取消
            $this->order->status = 'canceled';
            $this->order->save();

            // 回補庫存
            foreach ($this->order->orderitems as $item) {
                $product = $item->product;
                if ($product) {
                    $product->qty += $item->quantity;
                    $product->save();
                }
            }

            Log::info("訂單 {$this->order->id} 已取消，庫存已補回。");
        }
    }
}
