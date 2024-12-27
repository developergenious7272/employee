@extends('layouts.app')

@section('content')
  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card p-4">
                
                <h3>Employee Edition #{{ $employee->email}}</h3>

                <form method="POST" action="{{ route('employees.update',base64_encode($employee->id)) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="first_name" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="{{ old('first_name',$employee->first_name) }}">
                    @if($errors->has('first_name'))
                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" value="{{ old('last_name',$employee->last_name) }}">
                    @if($errors->has('last_name'))
                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email',$employee->email) }}">
                    @if($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>



                  <div class="form-group">
                    <label for="email">Phone:</label>
                    <div class="row g-3 align-items-center">
                      <div class="col-auto">
                        <select class="form-control" id="phone_code" name="phone_code" style="font-size:11px;">
                          <option value="">Select</option>
                          @if(isset($countries) && count($countries) )
                            @foreach($countries as $item)
                              <option value="{{$item->phone_code}}"
                                @if(isset($employee) && $employee->phone_code==$item->phone_code)
                                  {{ 'selected' }}
                                @endif
                              >
                              {{ ucfirst(strtolower($item->name)) }}
                              </option>
                            @endforeach
                          @endif
                        </select>
                        @if($errors->has('phone_code'))
                          <span class="text-danger">{{ $errors->first('phone_code') }}</span>
                        @endif
                      </div>  

                      <div class="col-auto">
                        <input type="phone_number" class="form-control" id="phone_number" placeholder="Enter phone_number" name="phone_number" value="{{ old('phone_number',$employee->phone_number) }}">


                        @if($errors->has('phone_number'))
                          <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                        @endif  
                      </div>

                    </div>
                  </div>


                  <div class="form-group">
                    <label for="gender">Gender:</label>
                    <br>
                    <input type="radio" id="male" name="gender" value="Male"
                      @if(isset($employee->gender) && $employee->gender=="Male")
                        {{ 'checked' }}
                      @endif
                    >
                    <label for="male">Male</label><br>

                    <input type="radio" id="female" name="gender" value="Female"
                      @if(isset($employee->gender) && $employee->gender=="Female")
                        {{ 'checked' }}
                      @endif
                    >
                    <label for="female">Female</label><br>
                    
                    <input type="radio" id="other" name="gender" value="Other"
                      @if(isset($employee->gender) && $employee->gender=="Other")
                        {{ 'checked' }}
                      @endif
                    >
                    <label for="other">Other</label><br>
                    
                    @if($errors->has('gender'))
                      <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                  </div>


                  <div class="form-group">
                    <label for="hobby_id">Hobbies:</label><br>

                    @if(isset($hobbies) && count($hobbies) )
                      @foreach($hobbies as $item)

                        <input type="checkbox" id="hob{{ $item->id }}" name="hobby_id[]" value="{{ $item->id }}"
                        {{ in_array($item->id, explode(",", $employee->hobby_id)) ? 'checked' : '' }}
                        >
                        <label for="hob{{ $item->id }}">{{ $item->name }}</label><br>

                      @endforeach
                    @endif

                    @if($errors->has('hobby_id'))
                      <span class="text-danger">{{ $errors->first('hobby_id') }}</span>
                    @endif
                  </div>



                  <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" placeholder="Enter Address" name="address" class="form-control" rows="4">{{ old('address',$employee->address) }}</textarea>
                    @if($errors->has('address'))
                      <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @if($errors->has('image'))
                      <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                  </div>


                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
