<div class="mb-3">
    <label class="form-label">Counseling Record</label>
    <select name="counseling_record_id" class="form-select" required>
        <option value="">Select Counseling Record</option>
        @foreach ($records as $record)
            <option value="{{ $record->id }}"
                @selected((string) old('counseling_record_id', $referral->counseling_record_id ?? $selectedRecordId ?? '') === (string) $record->id)>
                Record #{{ $record->id }} —
                {{ $record->appointment->student->first_name }}
                {{ $record->appointment->student->last_name }}
                ({{ $record->session_date->format('M d, Y') }})
            </option>
        @endforeach
    </select>
    @error('counseling_record_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Referral Type</label>
    <select name="referral_type" class="form-select" required>
        <option value="">Select Type</option>
        @foreach (['Academic', 'Medical', 'Psychological', 'Social Services', 'Other'] as $type)
            <option value="{{ $type }}"
                @selected(old('referral_type', $referral->referral_type ?? '') === $type)>
                {{ $type }}
            </option>
        @endforeach
    </select>
    @error('referral_type') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Destination / Office</label>
    <input name="destination" class="form-control" required maxlength="255"
           value="{{ old('destination', $referral->destination ?? '') }}">
    @error('destination') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Reason for Referral</label>
    <textarea name="reason" class="form-control" rows="4" required>{{ old('reason', $referral->reason ?? '') }}</textarea>
    @error('reason') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Referral Date</label>
    <input type="date" name="referral_date" class="form-control" required
           value="{{ old('referral_date', isset($referral) ? $referral->referral_date->format('Y-m-d') : date('Y-m-d')) }}">
    @error('referral_date') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
        @foreach (['pending', 'in_progress', 'completed', 'cancelled'] as $status)
            <option value="{{ $status }}"
                @selected(old('status', $referral->status ?? 'pending') === $status)>
                {{ ucwords(str_replace('_', ' ', $status)) }}
            </option>
        @endforeach
    </select>
    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
</div>
