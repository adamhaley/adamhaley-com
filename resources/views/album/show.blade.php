@extends('layouts.app')

@section('template_title')
    {{ $album->name ?? "{{ __('Show') Album" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Album</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('albums.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $album->name }}
                        </div>
                        <div class="form-group">
                            <strong>Cover Art:</strong>
                            {{ $album->cover_art }}
                        </div>
                        <div class="form-group">
                            <strong>Release Date:</strong>
                            {{ $album->release_date }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $album->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
