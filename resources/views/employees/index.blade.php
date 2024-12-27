@extends('layouts.app')

@section('content')
  
<div class="container">
    <!-- error/message -->
    <div>
        @if (Session::has('error'))
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <p>{!! Session::get('error') !!}</p>
            </div>
        @endif
        @if (Session::has('success'))
             <div class="alert alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <p>{!! Session::get('success') !!}</p>
             </div>
         @endif
    </div>
        </div>
        
<div class="container">
    <div class="text-right">
        <a href="employees/create" class="btn btn-dark mt-2">New Employee</a>
    </div>

  <table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>S.No.</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Action</th> 
      </tr>
    </thead>
    <tbody>
        @if($employees)
            @foreach ($employees as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        
                        <a href="{{ route('employees.show',base64_encode($item->id) )}}" class="btn btn-secondary">Show</a>
                        <a href="{{ route('employees.edit',base64_encode($item->id) )}}" class="btn btn-dark">Edit</a>
                        <form method="POST" action="{{ route('employees.destroy',base64_encode($item->id) )}}" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>

  </table>
    {{ $employees->links() }}
    
</div>

@endsection
