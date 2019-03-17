@extends('layouts.app')

@section('content')
        <a href="{{ route('categories.create') }}" class="mb-3 btn btn-primary float-right">Add New Category</a>
              
        @if (Session::has('message'))
            <div class="alert alert-success mt-5">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Task Category</th>
              <th scope="col">Created At</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
            <tr>
              <th scope="row">{{$category->id}}</th>
              <td>{{$category->categories}}</td>
              <td>{{$category->created_at->toFormattedDateString()}}</td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('categories.edit', $category->id) }}">
                      <button type="button" class="btn btn-warning mr-5">Edit</button>
                    </a>&nbsp;
                </div>
              </td>
              <td>
                <form action="{{url('categories', [$category->id])}}" method="POST">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
			      </td>
            </tr>
            @endforeach
          </tbody>
        </table>
@endsection
