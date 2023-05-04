@extends('layouts.app')

@section('template_title')
    {{ $track->name ?? "{{ __('Show') Track" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Track</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tracks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $track->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $track->description }}
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            {{ $track->image }}
                        </div>
                        <div class="form-group">
                            <strong>Lyrics:</strong>
                            {{ $track->lyrics }}
                        </div>
                        <div class="form-group">
                            <strong>Album Id:</strong>
                            {{ $track->album_id }}
                        </div>
                        <div class="form-group">
                            <strong>Order:</strong>
                            {{ $track->order }}
                        </div>
                        <div class="form-group">
                            <strong>File:</strong>
                            {{ $track->file }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
