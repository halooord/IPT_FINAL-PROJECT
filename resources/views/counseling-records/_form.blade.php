<div class="mb-3">
    <label class="form-label">Completed Appointment</label>
    <select name="appointment_id" class="form-select" required>
        <option value="">Select Appointment</option>
        @foreach ($appointments as $appointment)
            <option value="{{ $appointment->id }}"
                @selected((string) old('appointment_id', $record->appointment_id ?? $selectedAppointmentId ?? '') === (string) $appointment->id)>
                {{ $appointment->appointment_date->format('M d, Y h:i A') }}
                — {{ $appointment->student->first_name }} {{ $appointment->student->last_name }}
                with {{ $appointment->counselor->first_name }} {{ $appointment->counselor->last_name }}
            </option>
        @endforeach
    </select>
    @error('appointment_id') <div class="text-danger">{{ $message }}</div> @enderror
    @if ($appointments->isEmpty())
        <small class="text-muted">No eligible completed appointments are available.</small>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Session Date</label>
    <input type="date" name="session_date" class="form-control" required
           value="{{ old('session_date', isset($record) ? $record->session_date->format('Y-m-d') : '') }}">
    @error('session_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Counseling Notes</label>
    <textarea name="notes" class="form-control" rows="5" required>{{ old('notes', $record->notes ?? '') }}</textarea>
    @error('notes') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Outcome</label>
    <textarea name="outcome" class="form-control" rows="3">{{ old('outcome', $record->outcome ?? '') }}</textarea>
    @error('outcome') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Follow-up Date</label>
    <input type="date" name="follow_up_date" class="form-control"
           value="{{ old('follow_up_date', isset($record) && $record->follow_up_date ? $record->follow_up_date->format('Y-m-d') : '') }}">
    @error('follow_up_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>
