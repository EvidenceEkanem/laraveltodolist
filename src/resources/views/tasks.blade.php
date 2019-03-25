@extends('laraveltodolist::layouts.layout')

@section('content')
<div class="container">
    
        <div class="row">
			<div class="col-md-5 mb-3">
                   
				<div class="card border-0">
                    <div class="card-header">Task Categories</div>
					<div class="card-body">
						<div class="card-text">
                                
							<form action="{{ route('categories.store') }}" method="post">
                            {{ csrf_field() }}
                            
								<div class="input-group mb-3">
									<input type="text" required name="categories" class="form-control" placeholder="New Category">
									<div class="input-group-append">
                                    <button type="submit" class="btn btn-info text-white"><i class="fas fa-plus mr-1"></i>Add Category</button>
									</div>
								</div>
                            </form>       
                    <div class="modal fade" id="categoriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Task Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="" method="post" id="categories-update">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                    <label for="description">Categories</label>
                                    <input type="text" value="" class="form-control" name="categories" id="category">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info text-white">Update changes</button>
                            </div>
                        </form>
                            </div>
                        </div>

                       
                    </div>

							<table class="table table-striped table-hover">
								<tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                <a class="text-dark" href="{{ route('tasks.index') }}?category={{ $category->id }}">{{$category->categories}}
                                                
                                                    <span class="badge badge-info text-white rounded-circle">
                                                        {{count($category->tasks)}}
                                                    </span>
                                                    <br>
                                                    <small class="text-secondary">
                                                        Created on
                                                        {{ ($category->created_at->toFormattedDateString()) }}
                                                    </small>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-info text-white btn-sm" data-categories-id="{{$category->id}}" data-categories-category="{{$category->categories}}" data-toggle="modal" data-target="#categoriesModal"><i class="fas fa-pencil-alt"></i></button>
                                            </td>
                                            <td class="float-right">
                                                <form id="delete-category" class="ml-3 d-inline" action="{{ route('categories.delete', [$category->id])}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" onclick="confirmDelete('delete-category')" class="btn btn-danger btn-sm" ><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card border-0">
                    <div class="card-header">
                        <div>{{ $current_cat  ? " Task for {$current_cat->categories} " : "Task" }}</div>
                    </div>
					<div class="card-body">
                        <div class="card-text">
                            @if(null == $tasks)
                                <div class="input-group mb-3">
                                    <input type="text" disabled name="name" class="form-control" placeholder="New task">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-danger" type="submit"><i class="fas fa-plus mr-1"></i>Add Task</button>
                                    </div>
                                </div>
                                    
                                
                                <p class="text-center">Select a <strong>category</strong> to access tasks</p>
    
                            @else
                            <form action="{{ route('tasks.store') }}" method="post">
                                @csrf
								<div class="input-group mb-3">
                                    <input type="text" required name="name" class="form-control" placeholder="New task">
                                    <input type="hidden" name="category_id" value="{{ $current_cat->id ?? null }}">
									<div class="input-group-append">
										<button class="btn btn-danger" type="submit"><i class="fas fa-plus mr-1"></i>Add Task</button>
									</div>
								</div>
							</form>
                        </div>
                        
                <table class="table table-striped table-hover text-center">
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>
                                <span class="float-left">@if($task->completed==true) <del>{{$task->name}}</del> @else {{ $task->name }} @endif </span>
                                <br>
                                <small class="text-secondary float-left">
                                    Created
                                    {{ ($task->created_at->diffForHumans()) }}
                                </small>
                            </td>

                            <td>
                                <input class="mt-2" type="checkbox" name="" {{ $task->completed ? "checked" : ""  }} onchange="changestatus('{{$task->id}}')" class="float-left" value="{{ $task->completed }}" id="">
                            </td>

                            <td>
                                <form class="ml-3 d-inline" id="delete-task" action="{{ route('tasks.delete', [$task->id])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="confirmTaskDelete('delete-task')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
		   </div>
        @endif
		</div>
    </div>
   
@endsection

@section('script')
<script src="js/axios/axios.min.js"></script>

<script>
    
function changestatus(task_id)
{
    var form = new FormData;
    form.append("taskId", task_id);
    form.append("_token", "{{csrf_token()}}");
    axios.post("{{route('tasks.status')}}", form)
    .then(function(serverResponse) {
        window.location.reload();
    })
    .catch(function(error) {
        console.log(error.response.data);
    })
}

    var url = "{{ route('categories.update')}}"
    $("#categoriesModal").on('show.bs.modal', function(event){
        var btn = event.relatedTarget;
        var id = $(btn).data('categories-id');
        var categories = $(btn).data('categories-category');
        $("#category").val(categories);

        $("#categories-update").attr('action', url+'/'+id)
    })

    function confirmDelete(item_id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover the category!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#'+item_id).submit();
                    } else {
                        swal({
                            text: "Cancelled Successfully!",
                            icon: "info",
                        });
                    }
                });
        }

        

        function confirmTaskDelete(task_id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover the Task!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#'+task_id).submit();
                    } else {
                        swal({
                            text: "Cancelled Successfully!",
                            icon: "info",
                        });
                    }
                });
        }
</script>
@endsection
