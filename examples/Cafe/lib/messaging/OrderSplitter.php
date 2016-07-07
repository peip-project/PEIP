<?php

class OrderSplitter extends PEIP_ABS_Message_Splitter
{
    public function split(PEIP_INF_Message $message)
    {
        $order = $message->getContent();
        $orderItems = $order->getItems();
        $items = [];
        foreach ($orderItems as $item) {
            $nr = $item['number'];
            unset($item['number']);
            $item['order'] = $order->getOrderNumber();
            for ($x = 0; $x < $nr; $x++) {
                $items[] = $item;
            }
        }
        echo PEIP_LINE_SEPARATOR.'OrderSplitter: split order #: '.$order->getOrderNumber();

        return $items;
    }
}
