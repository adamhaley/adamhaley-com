@extends('layouts.app')

@section('template_title')
    {{ $client->name ?? "{{ __('Show') Client" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Client</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clients.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $client->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $client->description }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $client->email }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $client->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $client->address }}
                        </div>
                        <div class="form-group">
                            <strong>Url:</strong>
                            {{ $client->url }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
