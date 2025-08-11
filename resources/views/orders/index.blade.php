@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<!DOCTYPE html>
<html>
<head>
    <title>Orders Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div style="float:left" class="p-4 d-flex justify-content-center align-items-center">
    <img style="width:180px;" class="img-fluid" src="{{ asset('storage/images/Y-Not_logo.png ') }}" alt="Y-Not Logo" />
    <h2  class="mb-0"> Processed Orders</h2>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>PDF</th>
                <th>HTML Preview</th>
                <th>Status</th>
                <th>Customer Response</th>
                <th>Response Note</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>
                    @if(file_exists($order->pdf_path))
                        <a href="{{ asset('storage/pdfs/' . basename($order->pdf_path)) }}" target="_blank" class="btn btn-sm btn-outline-primary">View PDF</a>
                    @else
                        <span class="text-danger">Not Found</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/html/preview/' . $order->order_id) }}" class="btn btn-sm btn-primary" target="_blank">
                        HTML Preview
                    </a>                </td>
                <td>
                    @if($order->email_sent)
                        <span class="badge bg-success">Sent</span>
                    @else
                        <form action="{{ route('orders.send', ['order_id' => $order->order_id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-warning">Send Mail</button>
                        </form>  
                        <!-- <a href="{{ route('orders.send', ['order_id' => $order->order_id]) }}" class="btn btn-primary">Send Mail</a> -->
                    @endif
                </td>


<td>
    @if (!$order->customer_response)
        <!-- <span class="badge bg-success text-white">Accepted</span> -->
    @elseif (str_contains($order->customer_response, 'Placement'))
        <span class="badge bg-danger text-white">Placement Adjustments</span>
    @elseif (str_contains($order->customer_response, 'Color'))
        <span class="badge bg-danger text-white">Color Modifications</span>
    @else
        <span class="badge bg-success text-white">{{ $order->customer_response }}</span>
    @endif
</td>

                <td>{{ $order->response_note }}</td>
                <td>{{ $order->updated_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
