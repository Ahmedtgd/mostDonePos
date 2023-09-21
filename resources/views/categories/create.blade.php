
<x-app-layout>

<div class="container">
<div class="text-center mt-5"> 
        <h1>Create Categories</h1>
    </div>
</br>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
      
    
        <div class="form-group">
            <label for="category_name">category_name</label>
            <input type="text" name="category_name" class="form-control" required>
             </br>
            <label for="category_Description">Category_Description</label>
            <input type="text" name="category_description" class="form-control" required>
            
        </div>
</br>
     <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
</x-app-layout>
