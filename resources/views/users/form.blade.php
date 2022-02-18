<label for="name" class="form-label">Name</label>
<input type="text" class="form-input" name="name" id="name" value="{{ old('name', $user->name) }}">
<label for="email" class="form-label">Email</label>
<input type="text" class="form-input" name="email" id="email" value="{{ old('email', $user->email) }}">
{{-- Password can't be decrypted, thus, for edit, I think it might be wiser to remove the value here --}}
<label for="password" class="form-label">Password</label>
<input type="password" class="form-input" name="password" id="password">
<label for="role" class="form-label">Role</label>
<input type="text" class="form-input" name="role" id="role" value="{{ old('role', $user->role) }}">
