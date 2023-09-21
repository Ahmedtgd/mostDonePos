<x-app-layout>

<div class="container">
    <h1>Edit customer</h1>
    <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">email</label>
            <textarea name="email" class="form-control" rows="5" required>{{ $customer->email }}</textarea>
        </div>

      

        <div class="form-group">
            <label for="password">password</label>
            <input type="text" name="password" class="form-control" value="{{ $customer->password }}" required>
        </div>
      
       <div class="form-group">
            <label for="phone">phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" required>
        </div>

        <div class="form-group">
            <label for="address">address</label>
            <input type="text" name="address" class="form-control" value="{{ $customer->address }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</x-app-layout>
