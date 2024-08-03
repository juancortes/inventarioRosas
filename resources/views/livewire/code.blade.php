<div class="mb-3">
    <label for="name" class="form-label required">
        {{ __('Código') }}
    </label>

    <input type="text"
           id="code"
           name="code"
           wire:model.blur="code"
           wire:keyup="selectedName"
           placeholder="Código"
           class="form-control @error('code') is-invalid @enderror"
    />

    @error('code')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
