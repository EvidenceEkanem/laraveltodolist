@extends('layouts.app')

@section('content')
    <h1>Add New Categories</h1>
    <hr>
    
     <form action="/categories" method="post">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="description">Task Categories</label>
        <input type="text" class="form-control" id="taskCategories" name="Categories">
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection