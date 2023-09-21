<x-app-layout>

<div class="container">
<div class="text-center mt-5"> 
<h1>Products</h1>
    </div>  
</br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity}}</td>
                        
                        <td>{{ $product->category_name }}</td>
                        
                        
                        <div class="form-group">
      

     
                        <td>
                        <img src="{{ asset('storage/img/img1/' . $product->file) }}" width="240" height="120" style="border-radius: 10px;">
                        </td>
                        <td>
                        <img src="{{ asset('storage/img/img2/' . $product->fil) }}" width="240" height="120" style="border-radius: 10px;">
                        </td>

                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</br>
    <a href="{{ route('products.create') }}" class="btn btn-success">Create Product</a>
</br>
</div>
</x-app-layout>
