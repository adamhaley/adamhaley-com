<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $album->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cover_art') }}
            {{ Form::text('cover_art', $album->cover_art, ['class' => 'form-control' . ($errors->has('cover_art') ? ' is-invalid' : ''), 'placeholder' => 'Cover Art']) }}
            {!! $errors->first('cover_art', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('release_date') }}
            {{ Form::text('release_date', $album->release_date, ['class' => 'form-control' . ($errors->has('release_date') ? ' is-invalid' : ''), 'placeholder' => 'Release Date']) }}
            {!! $errors->first('release_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $album->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>