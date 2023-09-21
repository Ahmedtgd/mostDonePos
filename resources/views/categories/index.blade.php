<x-app-layout>
<div class="container">
<div class="text-center mt-5"> 
        <h1>Categories</h1>
    </div>
</br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
           
                    <th>category_name</th> 
                    <th>category_description</th>
                    <th>Action</th> 


                    
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_description }}</td>
                        
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
</br>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</br>
    <a href="{{ route('categories.create') }}" class="btn btn-success">Create category</a>
    </br>

</div>
</x-app-layout>

