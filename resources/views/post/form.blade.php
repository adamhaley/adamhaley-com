<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input
                id="title"
                name="title"
                type="text"
                value="{{ old('title', $post->title) }}"
                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                placeholder="Title"
            >
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="slug">{{ __('Slug') }}</label>
            <input
                id="slug"
                name="slug"
                type="text"
                value="{{ old('slug', $post->slug) }}"
                class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}"
                placeholder="Slug"
            >
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="body">{{ __('Body') }}</label>
            <input
                id="body"
                name="body"
                type="text"
                value="{{ old('body', $post->body) }}"
                class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                placeholder="Body"
            >
            {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input
                id="image"
                name="image"
                type="text"
                value="{{ old('image', $post->image) }}"
                class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                placeholder="Image"
            >
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <input
                id="tags"
                name="tags"
                type="text"
                value="{{ old('tags', $post->tags) }}"
                class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                placeholder="Tags"
            >
            {!! $errors->first('tags', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
