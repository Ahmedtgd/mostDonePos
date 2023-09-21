<x-app-layout>

    <div class="container">
    <div class="text-center mt-5"> 
        <h1>Edit Orders</h1>
    </div> 
        <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="deliveryStatus">Delivery Status:</label>
                <input type="text" id="deliveryStatus" name="deliveryStatus" class="form-control" required value="{{ $order->deliveryStatus }}">
            </div>

            <div class="form-group">
                <label for="vehicle">Vehicle:</label>
                <input type="text" id="vehicle" name="vehicle" class="form-control" required value="{{ $order->vehicle }}">
            </div>

            <div class="form-group">
                <label for="customer_id">Customer ID:</label>
                <input type="number" id="customer_id" name="customer_id" class="form-control" required value="{{ $order->customer_id }}">
            </div>
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" class="form-control" required value="{{ $order->user_id }}">
            </div>

            <div class="form-group">
                <label>Products:</label>
                @foreach ($order->products as $product)
                    <select name="product_ids[]" class="form-control">
                        <option value="">--- No Value ----</option>
                        @foreach ($products as $productOption)
                            <option value="{{ $productOption->id }}" {{ $productOption->id === $product->id ? 'selected' : '' }}>
                                {{ $productOption->name }} &nbsp; {{ $productOption->quantity }}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <input type="number" name="product_quantities[]" class="form-control"
                           value="{{ $product->pivot->quantity }}" placeholder="Enter Quantity">
                    <br>
                @endforeach
            </div>

            <div id="productFields" class="form-group">
                <!-- New fields will be added here dynamically -->
            </div>
</br>
            <button type="button" id="addProductButton" class="btn btn-secondary">Add product</button>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productFields = document.getElementById('productFields');
            const addProductButton = document.getElementById('addProductButton');
            let productCounter = 0; // Start from 0 to correctly sync with loop

            addProductButton.addEventListener('click', function() {
                const newProductField = `
                    <div class="form-group">
                        <label>Product ${productCounter + 1}</label>
                        <select name="product_ids[]" class="form-control">
                            <option value="">--- No Value ----</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} &nbsp; {{ $product->quantity }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="number" name="product_quantities[]" class="form-control" placeholder="Enter Quantity">
                    </div>
                `;

                productFields.insertAdjacentHTML('beforeend', newProductField);
                productCounter++;
            });
        });
    </script>

</x-app-layout>
