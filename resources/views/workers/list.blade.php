@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Сотрудники
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($workers) > 0)
                    <div class="panel-body">


                <!-- Поле поиска -->
          <!--   <form action="/search" method="POST" role="search">
                  {{ csrf_field() }}
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="поиск" aria-label="поиск">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"></button>
                </form>
             </form> -->


                <!-- Поле поиска -->
                <form action="/search" method="POST" role="search">
                  {{ csrf_field() }}
                  <div class="input-group">
                      <input type="text" class="form-control mr-sm-2" name="q"
                          placeholder="Поиск сотрудника">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Найти</button>
                        </span>
                  </div>
                </form>



                      <table class="table table-striped task-table">

                        <!-- Заголовок таблицы -->
                        <thead>
                          <th>id Paralax</th>
                          <th>Имя</th>
                          <th>Зарплата</th>
                          <th>Должность</th>
                          <th>Офис</th>
                        </thead>

                        <!-- Тело таблицы -->
                        <tbody>
                          @foreach ($workers as $worker)
                            <tr>
                              <td class="table-text">
                                <div>{{ $worker->idParalax }}</div>
                              </td>
                              <td class="table-text">
                                <div>{{ $worker->name }}</div>
                              </td>
                              <td class="table-text">
                                <div>{{ $worker->fixedSalary }}</div>
                              </td>
                              <td class="table-text">
                                <div>{{ $worker->namePost }}</div>
                              </td>
                              <td class="table-text">
                                <div>{{ $worker->nameOffice }}</div>
                              </td>
                              <td class="table-text">
                                <div>
                                  <form action="{{ url('workers/delete/'.$worker->id) }}" method="POST" class="delete">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger btn-sm" value="DELETE">
                                      <i class="fa fa-trash-o fa-fw"></i> Удалить
                                    </button>
                                  </form>
                                  <form action="{{ url('workers/edit/'.$worker->id) }}" method="GET">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                      <i class="fa fa-pencil fa-fw"></i> Изменить
                                    </button>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    @else
                        No Records
                    @endif
                    <br>
                    <br>

                    <button class="btn btn-primary" type="button" onclick="window.location='{{ url("workers/add") }}'">
                      <i class="fa fa-plus fa-fw"></i> Добавить нового сотрудника
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    $(".delete").on("submit", function(){
        return confirm("Вы уверены?");
    });
</script>
