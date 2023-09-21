<x-app-layout>

<div class="container">
<div class="text-center mt-5"> 
<h1>Edit Products</h1>
    </div>  
</br>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
       <label for="category_id">category</label>
      <select name="category_id" class="form-control">
      <option value="">Category</option>
      @foreach($categories as $category)
      <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{  $category->category_name  }}</option>
      @endforeach
      </select>
      </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label for="name">quantity</label>
            <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
        </div>
</br>
        <div class="form-group">
            <label for="file">Upload Image</label>
            <input type="file" name="file" class="form-control-file"   accept=".jpg, .jpeg, .png">
            <small class="form-text text-muted">Upload a new file only if you want to replace the existing one.</small>
        </div>
</br>
        <div class="form-group">
            <label for="fil">Upload Image</label>
            <input type="file" name="fil" class="form-control-file"  accept=".jpg, .jpeg, .png">
            <small class="form-text text-muted">Upload a new image only if you want to replace the existing one.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</x-app-layout>
