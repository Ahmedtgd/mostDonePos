  <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productFields = document.getElementById('productFields');
            const categoryFields = document.getElementById('categoryFields');
            const addProductButton = document.getElementById('addProductButton');
            let productCounter = 1;

            addProductButton.addEventListener('click', function() {
                const newCategoryField = `
                <div class="form-group">
                    <label> Category &nbsp; ${productCounter + 1} </label> 
                    <select id="newCategory"${productCounter} name="category_ids[]" class="form-control">
                        <option value="">--- No Value ----</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    <label> Product &nbsp; ${productCounter + 1} </label> 
                    <select id="newProduct" ${productCounter}name="product_ids[]" class="form-control">
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
                productFields.insertAdjacentHTML('beforeend', newProductField);
                productCounter++;
            });

            // Function to filter products based on the selected category
            function filterProducts(selectedCategory, productCounter) {
                const newCategoryDropdown = document.getElementById(`newCategory${productCounter}`);
                const newProductDropdown = document.getElementById(`newProduct${productCounter}`);

                newCategoryDropdown.addEventListener('change', function() {
                    const newSelectedCategoryId = newCategoryDropdown.value;

                    // Filter products based on the selected category
                    Array.from(newProductDropdown.options).forEach(function(option) {
                        if (newSelectedCategoryId === '' || option.getAttribute('data-category') === newSelectedCategoryId) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                });
            }

            // Add an event listener to the category dropdown for the initial fields
            const categoryDropdown = document.getElementById('category');
            const productDropdown = document.getElementById('product');

            categoryDropdown.addEventListener('change', function() {
                const selectedCategoryId = categoryDropdown.value;

                // Filter products based on the selected category
                Array.from(productDropdown.options).forEach(function(option) {
                    if (selectedCategoryId === '' || option.getAttribute('data-category') === selectedCategoryId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        });
    </script>
