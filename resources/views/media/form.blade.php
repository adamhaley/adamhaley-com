<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="category_id">{{ __('Category Id') }}</label>
            <input
                id="category_id"
                name="category_id"
                type="text"
                value="{{ old('category_id', $medium->category_id) }}"
                class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                placeholder="Category Id"
            >
            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $medium->name) }}"
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                placeholder="Name"
            >
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="path">{{ __('Path') }}</label>
            <input
                id="path"
                name="path"
                type="text"
                value="{{ old('path', $medium->path) }}"
                class="form-control{{ $errors->has('path') ? ' is-invalid' : '' }}"
                placeholder="Path"
            >
            {!! $errors->first('path', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
