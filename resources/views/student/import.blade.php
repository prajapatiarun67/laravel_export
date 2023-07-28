@extends('layouts.app')
@section('content') 
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
       <div class="container"> 
            <div class="btn-section">
                <h2>Import Excel</h2>  
            </div>   
            <form method="POST" action="{{ route('student.import_store') }}" id="uploadForm"  enctype="multipart/form-data">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <?php 
                            if(isset($excelFields))
                            {
                                echo "<div class='modal-header'>
                                    <div style='font-size:13px, font-weight:bold'>Excel columns : <span>$excelFields</span></div>       
                                </div> ";
                            }
                        ?>
                        <label>Choose File</label> 
                        <input type="file" placeholder="Choose file" name="file" id="customFile" class="form-control">
                        @if($errors->has('file'))
                            <div class="text-danger">{{ $errors->first('file') }}</div>
                        @endif
                    </div> 
                </div>
                <a href="{{ route('student.index') }}">
                    <button type="button" class="btn btn-danger">cancel</button>
                </a>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>
    </div>
@endsection