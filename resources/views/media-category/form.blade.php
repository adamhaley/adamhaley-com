<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $mediaCategory->name) }}"
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
                value="{{ old('description', $mediaCategory->description) }}"
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
