<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Tasks</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="row d-flex justify-content-center container">
            <a href="{{route('logout')}}" class="text-light">Logout</a>
            <div class="col-md-8">
              <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                  <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                      class="fa fa-tasks"></i>&nbsp;Todo Lists</div>

                </div>
                <div class="scroll-area-sm">
                  <perfect-scrollbar class="ps-show-limits">
                    <div style="position: static;" class="ps ps--active-y">
                      <div class="ps-content">
                        <ul class=" list-group list-group-flush">
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
                                        <button class="border-0 btn-transition btn btn-outline-success">
                                            <i class="fa fa-pencil"></i></button>
                                        <button class="border-0 btn-transition btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </div>
                                    </div>
                                    </div>
                                </li>
                            @endforeach
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
        <form method="POST" action="{{route('todo.add')}}">
            <div class="modal fade" id="newTodoModal" tabindex="-1" aria-labelledby="newTodoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-center" id="newTodoModalLabel">Add Todo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <label for="todo-title" class="col-form-label">Title:</label>
                          <input type="text" name="title" class="form-control" id="todo-title" required>
                        </div>
                        <div class="form-group">
                          <label for="todo-description"class="col-form-label">Description:</label>
                          <textarea class="form-control" name="description" id="todo-description"></textarea>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </div>
                </div>
            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>
