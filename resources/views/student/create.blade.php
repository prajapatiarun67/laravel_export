@extends('layouts.app')
@section('content') 
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
       <div class="container"> 
            <div class="btn-section">
                <h2>Add Student</h2>  
            </div>   
            <form method="POST" action="{{ route('student.store') }}" id="save-frm" enctype='multipart/form-data'>
                @csrf 
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="location" class="form-control" id="location" placeholder="Enter location" name="location" value="{{ old('location') }}">
                    @if($errors->has('location'))
                        <div class="text-danger">{{ $errors->first('location') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="text" class="form-control" id="pwd" placeholder="Enter Pincode" name="pincode" value="{{ old('pincode') }}">
                    @if($errors->has('pincode'))
                        <div class="text-danger">{{ $errors->first('pincode') }}</div>
                    @endif
                </div>
                <a href="{{ route('student.index') }}">
                    <button type="button" class="btn btn-danger">cancel</button>
                </a>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>
    </div>
@endsection