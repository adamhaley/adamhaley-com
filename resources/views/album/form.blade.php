<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $album->name) }}"
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                placeholder="Name"
            >
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="cover_art">{{ __('Cover Art') }}</label>
            <input
                id="cover_art"
                name="cover_art"
                type="text"
                value="{{ old('cover_art', $album->cover_art) }}"
                class="form-control{{ $errors->has('cover_art') ? ' is-invalid' : '' }}"
                placeholder="Cover Art"
            >
            {!! $errors->first('cover_art', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="release_date">{{ __('Release Date') }}</label>
            <input
                id="release_date"
                name="release_date"
                type="text"
                value="{{ old('release_date', $album->release_date) }}"
                class="form-control{{ $errors->has('release_date') ? ' is-invalid' : '' }}"
                placeholder="Release Date"
            >
            {!! $errors->first('release_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <input
                id="description"
                name="description"
                type="text"
                value="{{ old('description', $album->description) }}"
                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                placeholder="Description"
            >
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
