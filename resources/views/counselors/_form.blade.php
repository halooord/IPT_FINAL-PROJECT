<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Employee ID</label>
        <input name="employee_number" class="form-control" required
               value="{{ old('employee_number', $counselor->employee_number ?? '') }}">
        @error('employee_number') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required
               value="{{ old('email', $counselor->email ?? '') }}">
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">First Name</label>
        <input name="first_name" class="form-control" required
               value="{{ old('first_name', $counselor->first_name ?? '') }}">
        @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Last Name</label>
        <input name="last_name" class="form-control" required
               value="{{ old('last_name', $counselor->last_name ?? '') }}">
        @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Phone</label>
        <input type="tel" name="phone" class="form-control" inputmode="numeric" pattern="[0-9]*"
               value="{{ old('phone', $counselor->phone ?? '') }}">
        @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Specialization</label>
        <input name="specialization" class="form-control" required
               value="{{ old('specialization', $counselor->specialization ?? '') }}">
        @error('specialization') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select" required>
            <option value="1" @selected((string) old('is_active', isset($counselor) ? (int) $counselor->is_active : 1) === '1')>
                Active
            </option>
            <option value="0" @selected((string) old('is_active', isset($counselor) ? (int) $counselor->is_active : 1) === '0')>
                Inactive
            </option>
        </select>
        @error('is_active') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
</div>