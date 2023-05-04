@extends('layouts.app')

@section('template_title')
    Project Category
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Project Category') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('project-categories.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Description</th>
										<th>Parent Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectCategories as $projectCategory)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $projectCategory->name }}</td>
											<td>{{ $projectCategory->description }}</td>
											<td>{{ $projectCategory->parent_id }}</td>

                                            <td>
                                                <form action="{{ route('project-categories.destroy',$projectCategory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('project-categories.show',$projectCategory->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('project-categories.edit',$projectCategory->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $projectCategories->links() !!}
            </div>
        </div>
    </div>
@endsection
