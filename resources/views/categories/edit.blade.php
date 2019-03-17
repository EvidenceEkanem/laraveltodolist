@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>
    <hr>
     <form action="{{ route('categories.update', $category->id) }}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}

      <div class="form-group">
        <label for="description">Task Categories</label>
        <input type="text" value="{{$category->categories}}" class="form-control" name="categories" >
      </div>
      
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection