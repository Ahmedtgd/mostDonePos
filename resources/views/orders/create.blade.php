<x-app-layout>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Create Orders</h1>
        </div>
        <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="deliveryStatus">Delivery Status:</label>
                <input type="text" id="deliveryStatus" name="deliveryStatus" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="vehicle">Vehicle:</label>
                <input type="text" id="vehicle" name="vehicle" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="customer_id">Customer ID:</label>
                <input type="number" id="customer_id" name="customer_id" class="form-control" required>
            </div>
            <br><br>
            <!-- Products Dropdown -->
            <div class="form-group container">
                <label for="category">1 - Category:</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">--- Select a Category ---</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            

                 <!-- Products Dropdown -->
            
                <label>1 - Products:</label>
                <select id="product" name="product_ids[]" class="form-control">
                    <option value="">--- No Value ----</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-category="{{ $product->category_id }}">{{ $product->name }} &nbsp; {{ $product->quantity }}</option>
                    @endforeach
                </select>
                <br>
                <input type="number" name="product_quantities[]" class="form-control" placeholder="Enter Quantity">
            </div>
            <div class="container">
                <div id="categoryFields" class="form-group">
                    <!-- New category fields will be added here dynamically -->
                </div>
                <div id="productFields" class="form-group">
                    <!-- New fields will be added here dynamically -->
                </div>
            </div>
            <button type="button" id="addProductButton" class="btn btn-secondary">Add product</button>

            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productFields = document.getElementById('productFields');
        const categoryFields = document.getElementById('categoryFields');
        const addProductButton = document.getElementById('addProductButton');
        let productCounter = 1;

        function filterProducts(categoryDropdown, productDropdown) {
            const selectedCategoryId = categoryDropdown.value;

            // Filter products based on the selected category
            Array.from(productDropdown.options).forEach(function(option) {
                if (selectedCategoryId === '' || option.getAttribute('data-category') === selectedCategoryId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        // Add an event listener to the category dropdown for the initial fields
        const initialCategoryDropdown = document.getElementById('category');
        const initialProductDropdown = document.getElementById('product');

        initialCategoryDropdown.addEventListener('change', function() {
            filterProducts(initialCategoryDropdown, initialProductDropdown);
        });

        // Event delegation for dynamically generated fields
        categoryFields.addEventListener('change', function(event) {
            const target = event.target;
            if (target.tagName === 'SELECT' && target.name === 'category_ids[]') {
                // Find the corresponding product dropdown
                const productDropdown = document.getElementById(`newProduct${target.dataset.counter}`);
                filterProducts(target, productDropdown);
            }
        });

        addProductButton.addEventListener('click', function() {
            const newCategoryField = `
            <br><br>
            <div class="form-group container">
                <label>${productCounter + 1} - Category</label>
                <select id="newCategory${productCounter}" name="category_ids[]" class="form-control" data-counter="${productCounter}">
                    <option value="">--- No Value ----</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>

                <label>${productCounter + 1} - Product</label>
                <select id="newProduct${productCounter}" name="product_ids[]" class="form-control">
                    <option value="">--- No Value ----</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-category="{{ $product->category_id }}">{{ $product->name }} &nbsp; {{ $product->quantity }}</option>
                    @endforeach
                </select>
                <br>
                <input type="number" name="product_quantities[]" class="form-control" placeholder="Enter Quantity">
            </div>
        `;

            categoryFields.insertAdjacentHTML('beforeend', newCategoryField);
            productCounter++;
        });
    });
</script>


</x-app-layout>
