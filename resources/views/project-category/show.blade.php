@extends('layouts.app')

@section('template_title')
    {{ $projectCategory->name ?? "{{ __('Show') Project Category" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Project Category</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('project-categories.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $projectCategory->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $projectCategory->description }}
                        </div>
                        <div class="form-group">
                            <strong>Parent Id:</strong>
                            {{ $projectCategory->parent_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
