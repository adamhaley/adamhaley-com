<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="category_id">{{ __('Category Id') }}</label>
            <input
                id="category_id"
                name="category_id"
                type="text"
                value="{{ old('category_id', $project->category_id) }}"
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
                value="{{ old('name', $project->name) }}"
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
                value="{{ old('description', $project->description) }}"
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
                value="{{ old('image', $project->image) }}"
                class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                placeholder="Image"
            >
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="link">{{ __('Link') }}</label>
            <input
                id="link"
                name="link"
                type="text"
                value="{{ old('link', $project->link) }}"
                class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
                placeholder="Link"
            >
            {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="github">{{ __('Github') }}</label>
            <input
                id="github"
                name="github"
                type="text"
                value="{{ old('github', $project->github) }}"
                class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}"
                placeholder="Github"
            >
            {!! $errors->first('github', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <input
                id="tags"
                name="tags"
                type="text"
                value="{{ old('tags', $project->tags) }}"
                class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                placeholder="Tags"
            >
            {!! $errors->first('tags', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input
                id="date"
                name="date"
                type="text"
                value="{{ old('date', $project->date) }}"
                class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                placeholder="Date"
            >
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
