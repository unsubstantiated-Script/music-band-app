<div>
    <form wire:submit.prevent="submitMusician">
        @csrf
        <div class="form-group">
            <label for="first_name" class="form-label">First Name</label>
            <input class="h-10" type="text" wire:model="firstName">
            <div>
                @error('firstName')
                    <span class="text-red-600 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="first_name" class="form-label">Last Name</label>
            <input class="h-10" type="text" wire:model="lastName">
            <div>
                @error('lastName')
                    <span class="text-red-600 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="first_name" class="form-label">Instrument</label>
            <input class="h-10" type="text" wire:model="instrument">
            <div>
                @error('instrument')
                    <span class="text-red-600 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="first_name" class="form-label">Website</label>
            <input class="h-10" type="text" wire:model="website">
            <div>
                @error('website')
                    <span class="text-red-600 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">{{ $musician ? 'Update' : 'Add' }} Musician</button>
            <a class="btn btn-error" href="{{ route('musicians-livewire') }}">Cancel</a>
        </div>
    </form>
</div>
