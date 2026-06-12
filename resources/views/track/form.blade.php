<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $track->name) }}"
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                placeholder="Name"
            >
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <input
                id="description"
                name="description"
                type="text"
                value="{{ old('description', $track->description) }}"
                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                placeholder="Description"
            >
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input
                id="image"
                name="image"
                type="text"
                value="{{ old('image', $track->image) }}"
                class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                placeholder="Image"
            >
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="lyrics">{{ __('Lyrics') }}</label>
            <input
                id="lyrics"
                name="lyrics"
                type="text"
                value="{{ old('lyrics', $track->lyrics) }}"
                class="form-control{{ $errors->has('lyrics') ? ' is-invalid' : '' }}"
                placeholder="Lyrics"
            >
            {!! $errors->first('lyrics', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="album_id">{{ __('Album Id') }}</label>
            <input
                id="album_id"
                name="album_id"
                type="text"
                value="{{ old('album_id', $track->album_id) }}"
                class="form-control{{ $errors->has('album_id') ? ' is-invalid' : '' }}"
                placeholder="Album Id"
            >
            {!! $errors->first('album_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="order">{{ __('Order') }}</label>
            <input
                id="order"
                name="order"
                type="text"
                value="{{ old('order', $track->order) }}"
                class="form-control{{ $errors->has('order') ? ' is-invalid' : '' }}"
                placeholder="Order"
            >
            {!! $errors->first('order', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="file">{{ __('File') }}</label>
            <input
                id="file"
                name="file"
                type="text"
                value="{{ old('file', $track->file) }}"
                class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}"
                placeholder="File"
            >
            {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
