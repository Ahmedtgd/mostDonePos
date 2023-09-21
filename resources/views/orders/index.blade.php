<x-app-layout>

    <div class="container">
    <div class="text-center mt-5"> 
        <h1>Orders</h1>
    </div>        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Delivery Status</th>
                        <th>Vehicle</th>
                        <th>Customer ID</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->deliveryStatus }}</td>
                            <td>{{ $order->vehicle }}</td>
                            <td>{{ $order->customer_id }}</td>
                          <td>
                          Id:{{ $order->user_id }}
                          </br> 
                         Name:{{ $order->user->name }}
                           </td>
                            <td>
                            @foreach ($order->products as $product)
                                <li>{{ $product->name }}</li>
                            @endforeach
                            </td>
                            <td>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</br>
        <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-6">
                <!-- Your content goes here -->
            </div>
            <div class="col-6 text-right">
                <div class="pagination-container">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</br>
        <a href="{{ route('orders.create') }}" class="btn btn-success">Create Order</a>
        </br>

    </div>
    </br>

</x-app-layout>

