@extends('layouts.app')

@section('template_title')
    {{ $media->name ?? "{{ __('Show') Media" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Media</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('media.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Category Id:</strong>
                            {{ $media->category_id }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $media->name }}
                        </div>
                        <div class="form-group">
                            <strong>Path:</strong>
                            {{ $media->path }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
