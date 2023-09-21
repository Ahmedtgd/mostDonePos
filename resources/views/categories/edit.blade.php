<x-app-layout>

<div class="container">
<div class="text-center mt-5"> 
        <h1>Edit Categories</h1>
    </div>
</br>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

      
        
        <div class="form-group">
            <label for="category_name">category_name</label>
            </br>

            <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
            </br>
            <label for="category_name">category_describtion</label>
            </br>
            <input type="text" name="category_description" class="form-control" value="{{ $category->category_description }}" required>

        </div>


        </br>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</x-app-layout>
