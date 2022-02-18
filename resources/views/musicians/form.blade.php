<label for="first_name" class="form-label">First Name</label>
<input type="text" class="form-input" name="first_name" id="first_name"
    value="{{ old('first_name', $musician->first_name) }}">
<label for="last_name" class="form-label">Last Name</label>
<input type="text" class="form-input" name="last_name" id="last_name"
    value="{{ old('last_name', $musician->last_name) }}">
<label for="instrument" class="form-label">Instrument</label>
<input type="text" class="form-input" name="instrument" id="instrument"
    value="{{ old('instrument', $musician->instrument) }}">
<label for="website" class="form-label">Website</label>
<input type="text" class="form-input" name="website" id="website" value="{{ old('website', $musician->website) }}">
