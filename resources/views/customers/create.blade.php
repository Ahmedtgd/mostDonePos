
<x-app-layout>

<div class="container">
    <h1>Create customer</h1>
    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
      
       
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">email</label>
            <textarea name="email" class="form-control" rows="5" required></textarea>
        </div>

        

        <div class="form-group">
            <label for="password"> password</label>
            <input type="text" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone"> phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address"> address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
       

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
</x-app-layout>
