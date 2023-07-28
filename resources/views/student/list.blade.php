@extends('layouts.app')
@section('content') 
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
       <div class="container"> 
             @if (session('success_msg'))
                <div class="alert alert-success">
                    {{ session('success_msg') }}
                </div>
            @endif
            <div class="btn-section">
                <h2>Student Table</h2>  
                <span>
                    <a href="{{ route('student.index') }}/create" class="mr-1">
                        <button type="button" class="btn btn-primary">Add</button> 
                    </a>
                    <a href="{{ route('student.index') }}/import" class="mr-1">
                        <button type="button" class="btn btn-info">Import</button>
                    </a>
                    <a href="{{ route('student.index') }}/export" class="mr-1">
                        <button type="button" class="btn btn-success">Export</button>
                    </a>
                </span>
            </div>   
            <table class="table">
                <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Pincode</th>
                    <th>Created At</th>
                    <th>Updated At</th> 
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($data) && $data->count()) 
                    @foreach($data as $key => $value)
                    
                        <tr> 
                                <td>{{ $loop->iteration }}</td> 
                                <td>{{ $value->name }}</td>  
                                <td>{{ $value->email }}</td>    
                                <td>{{ $value->location }}</td>    
                                <td>{{ $value->pincode }}</td>   
                                <td>{{ date('d M, Y', strtotime($value->created_at)) }} </td> 
                                <td>{{ date('d M, Y', strtotime($value->updated_at)) }} </td> 
                                <td>
                                    <a href="{{ route('student.edit', ['sid' => $value->id]) }}" class="mr-1">
                                        <button type="button" class="btn btn-warning">Edit</button> 
                                    </a>
                                    <a href="javascript:void(0);" onclick="_delete('{{route('student.destroy', ['sid' => $value->id])}}')" title="Delete" class="btn btn-danger btn-xs">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr> 
                            
                    @endforeach
                @else
                    <tr>
                        <td colspan="8  "><center><i>No Records Found!</i></center></td>
                    </tr>
                @endif

                <tr>
                    <td colspan="8">{!! $data->links() !!} </td>  
                </tr>   
                </tbody>
            </table>
            </div>
    </div>
@endsection