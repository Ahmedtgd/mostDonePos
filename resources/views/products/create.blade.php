
<x-app-layout>

<div class="container">
<div class="text-center mt-5"> 
<h1>Create Products</h1>
    </div>  
</br>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
    <label> Category </label> 
    <select name = "category_id" class="form-control">
        <option value="">Category</option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->category_name }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
            <label for="name">quantity</label>
            <input type="text" name="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" required>
        </div>
      

      

        <div class="form-group">
            <label for="file">Upload File</label>
            <input type="file" name="file" class="form-control-file"   accept=".jpg, .jpeg, .png">
        </div>

        <div class="form-group">
            <label for="fil">Upload Image</label>
            <input type="file" name="fil" class="form-control-file"  accept=".jpg, .jpeg, .png">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
</x-app-layout>
