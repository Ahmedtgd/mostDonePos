<x-app-layout>

<div class="container">
    <h1>customers</h1>
    <div class="table-responsive">
        <table class="table table-bcustomered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                <th>name</th>
                <th>email</th>
                
                <th>password</th>
                <th>phone</th>
                <th>address</th>   
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->password }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>

                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
</br>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline-block;">
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
    <a href="{{ route('customers.create') }}" class="btn btn-success">Create customer</a>
</div>
</x-app-layout>

