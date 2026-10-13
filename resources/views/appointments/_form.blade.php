<div class="mb-3">
    <label class="form-label">Student</label>
    <select name="student_id" class="form-select" required>
        <option value="">Select Student</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}"
                @selected((string) old('student_id', $appointment->student_id ?? '') === (string) $student->id)>
                {{ $student->student_number }} - {{ $student->first_name }} {{ $student->last_name }}
            </option>
        @endforeach
    </select>
    @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Counselor</label>
    <select name="counselor_id" class="form-select" required>
        <option value="">Select Counselor</option>
        @foreach ($counselors as $counselor)
            <option value="{{ $counselor->id }}"
                @selected((string) old('counselor_id', $appointment->counselor_id ?? '') === (string) $counselor->id)>
                {{ $counselor->first_name }} {{ $counselor->last_name }}
                {{ $counselor->is_active ? '' : '(Inactive - existing appointment)' }}
            </option>
        @endforeach
    </select>
    @error('counselor_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Appointment Date and Time</label>
    <input type="datetime-local" name="appointment_date" class="form-control" required
           value="{{ old('appointment_date', isset($appointment) ? $appointment->appointment_date->format('Y-m-d\TH:i') : '') }}">
    @error('appointment_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Purpose</label>
    <input name="purpose" class="form-control" required maxlength="255"
           value="{{ old('purpose', $appointment->purpose ?? '') }}">
    @error('purpose') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Student Concern</label>
    <textarea name="student_concern" class="form-control" rows="4">{{ old('student_concern', $appointment->student_concern ?? '') }}</textarea>
    @error('student_concern') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
        @foreach (['pending', 'approved', 'completed', 'cancelled'] as $status)
            <option value="{{ $status }}"
                @selected(old('status', $appointment->status ?? 'pending') === $status)>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
</div>
