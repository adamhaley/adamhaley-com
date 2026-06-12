<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $client->name) }}"
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
                value="{{ old('description', $client->description) }}"
                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                placeholder="Description"
            >
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="text"
                value="{{ old('email', $client->email) }}"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                placeholder="Email"
            >
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input
                id="phone"
                name="phone"
                type="text"
                value="{{ old('phone', $client->phone) }}"
                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                placeholder="Phone"
            >
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <input
                id="address"
                name="address"
                type="text"
                value="{{ old('address', $client->address) }}"
                class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                placeholder="Address"
            >
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="url">{{ __('Url') }}</label>
            <input
                id="url"
                name="url"
                type="text"
                value="{{ old('url', $client->url) }}"
                class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                placeholder="Url"
            >
            {!! $errors->first('url', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
