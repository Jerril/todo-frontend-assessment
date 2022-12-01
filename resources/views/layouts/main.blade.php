<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>ToDo List</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="row d-flex justify-content-center container">
            <div class="col-md-8">
              <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header d-flex justify-content-between">
                  <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="fa fa-tasks"></i>&nbsp;Todo Lists
                  </div>
                  <div>
                    <a type="button" href="{{route('logout')}}" class="btn btn-primaty text-primary">Logout</a>
                  </div>
                </div>

                <div class="scroll-area-sm">
                    @if (Session::has('msg'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('msg') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <perfect-scrollbar class="ps-show-limits">
                    <div style="position: static;" class="ps ps--active-y">
                      <div class="ps-content">
                        <ul class=" list-group list-group-flush">
                            @if($todos)
                            @foreach ($todos as $todo)
                                <li class="list-group-item">
                                    <div class="todo-indicator bg-warning"></div>
                                    <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                        <div class="widget-heading">{{$todo['title'] ?? ''}}</div>
                                        <div class="widget-subheading"><i>{{$todo['description'] ?? ''}}</i></div>
                                        </div>

                                        <div class="widget-content-right">
                                        <button class="border-0 btn-transition btn btn-outline-success" type="button" data-toggle="modal" data-target="#editTodoModal{{$todo['_id']}}">
                                            <i class="fa fa-pencil"></i></button>
                                        <a href="{{route('todo.delete', ['id' => $todo['_id']])}}" class="border-0 btn-transition btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        </div>
                                    </div>
                                    </div>
                                </li>
                                <!-- Edit Task Modal -->
                                <div class="modal fade" id="editTodoModal{{$todo['_id']}}" tabindex="-1" aria-labelledby="editTodoModal{{$todo['_id']}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title text-center" id="editTodoModal{{$todo['_id']}}Label">Edit Todo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form method="POST" action="{{route('todo.update', ['id' => $todo['_id']])}}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                <label for="todo-title" class="col-form-label">Title:</label>
                                                <input type="text" name="title" class="form-control" id="todo-title" value="{{$todo['title']??''}}" required>
                                                </div>
                                                <div class="form-group">
                                                <label for="todo-description"class="col-form-label">Description:</label>
                                                <textarea class="form-control" name="description" id="todo-description" required>{{$todo['description']??''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <div class="alert alert-warning mx-auto my-3">
                                    <p>You don't have any ToDo currently. Create a new one using the "Add Todo" button below</p>
                                </div>
                            @endif
                        </ul>
                      </div>

                    </div>
                  </perfect-scrollbar>
                </div>
                <div class="d-block text-right card-footer">
                    <button type="button" data-toggle="modal" data-target="#newTodoModal" class="btn btn-primary">Add Todo</button></div>
              </div>
            </div>
        </div>

        <!-- Add New Task Modal -->
        <div class="modal fade" id="newTodoModal" tabindex="-1" aria-labelledby="newTodoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="newTodoModalLabel">Add Todo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  method="POST" action="{{route('todo.add')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="todo-title" class="col-form-label">Title:</label>
                        <input type="text" name="title" class="form-control" id="todo-title" required>
                        </div>
                        <div class="form-group">
                        <label for="todo-description"class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="todo-description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
