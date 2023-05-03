<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $track->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $track->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('image') }}
            {{ Form::text('image', $track->image, ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'placeholder' => 'Image']) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lyrics') }}
            {{ Form::text('lyrics', $track->lyrics, ['class' => 'form-control' . ($errors->has('lyrics') ? ' is-invalid' : ''), 'placeholder' => 'Lyrics']) }}
            {!! $errors->first('lyrics', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('album_id') }}
            {{ Form::text('album_id', $track->album_id, ['class' => 'form-control' . ($errors->has('album_id') ? ' is-invalid' : ''), 'placeholder' => 'Album Id']) }}
            {!! $errors->first('album_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('order') }}
            {{ Form::text('order', $track->order, ['class' => 'form-control' . ($errors->has('order') ? ' is-invalid' : ''), 'placeholder' => 'Order']) }}
            {!! $errors->first('order', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('file') }}
            {{ Form::text('file', $track->file, ['class' => 'form-control' . ($errors->has('file') ? ' is-invalid' : ''), 'placeholder' => 'File']) }}
            {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>