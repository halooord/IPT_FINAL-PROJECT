
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="student_number">Student ID</label>
        <input type="text" name="student_number" id="student_number"
            value="{{ old('student_number', $student->student_number ?? '') }}"
            class="form-control" required>
        @error('student_number')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email"
            value="{{ old('email', $student->email ?? '') }}"
            class="form-control" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name"
            value="{{ old('first_name', $student->first_name ?? '') }}"
            class="form-control" required>
        @error('first_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name"
            value="{{ old('last_name', $student->last_name ?? '') }}"
            class="form-control" required>
        @error('last_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="phone">Phone</label>
        <input type="tel" name="phone" id="phone" inputmode="numeric" pattern="[0-9]*"
            value="{{ old('phone', $student->phone ?? '') }}"
            class="form-control">
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="program">Program</label>
        <select name="program" id="program" class="form-select" required>
            <option value="">Select Program</option>
            @foreach (['BSIT', 'BSHM', 'BSED', 'BSN', 'BSCRIM', 'BSTM', 'BSBA', 'BSMA'] as $program)
                <option value="{{ $program }}"
                    @selected(old('program', $student->program ?? '') === $program)>
                    {{ $program }}
                </option>
            @endforeach
        </select>
        @error('program')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="year_level">Year Level</label>
        <select name="year_level" id="year_level" class="form-select" required>
            <option value="">Select Year Level</option>
            @foreach (['1st Year', '2nd Year', '3rd Year', '4th Year'] as $year)
                <option value="{{ $year }}"
                    @selected(old('year_level', $student->year_level ?? '') === $year)>
                    {{ $year }}
                </option>
            @endforeach
        </select>
        @error('year_level')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($student) ? 'Update Student' : 'Save Student' }}
</button>
<a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
