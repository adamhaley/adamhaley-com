@extends('layouts.app')

@section('template_title')
    {{ $post->name ?? "{{ __('Show') Post" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Post</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('posts.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $post->title }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $post->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Body:</strong>
                            {{ $post->body }}
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            {{ $post->image }}
                        </div>
                        <div class="form-group">
                            <strong>Tags:</strong>
                            {{ $post->tags }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
