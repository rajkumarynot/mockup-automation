<h3>New Customer Response Received</h3>

<p>Order ID: {{ $order->order_id }}</p>
<p>Customer Name: {{ $order->customer_name }}</p>
<p>Customer Email: {{ $order->customer_email }}</p>
<p>Response: {{ $order->response }}</p>
@if($order->response_note)
<p>Note from customer:</p>
<p>{{ $order->response_note }}</p>
@endif
