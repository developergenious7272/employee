@extends('layouts.app')

@section('content')
  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card p-4">
                
                <h3>Employee Show</h3>

                <p>First Name :- {{ $employee->first_name}}</p>
                <p>Last Name :- {{ $employee->last_name}}</p>
                <p>Email :- {{ $employee->email}}</p>
                <p>Phone : {{ $employee->phone_number ? ( $employee->phone_code .'-'.$employee->phone_number) : '' }}</p>
                <p>Address :- {{ $employee->address}}</p>
                <p>Gender :- {{ $employee->gender}}</p>
                <p>Hobbies :- 
                    @if(isset($hobbies) && count($hobbies) )
                      @foreach($hobbies as $item)

                        {{ in_array($item->id, explode(",", $employee->hobby_id)) ? ($item->name.',') : '' }}

                      @endforeach
                    @endif
                </p>

                @if($employee->image)
                Image:
                    <img src="{{ asset('uploads/employees').'/'.$employee->image }}" width=100 height=100>
                @else
                    <img src='{{ asset('images').'/default.jpg' }}' width=100 height=100>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
