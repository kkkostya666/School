<div class="form-group">
    <label for="mark">Оценка</label>
    <input type="text" class="form-control" id="mark"
           value="{{ $mark ?? '' }}"
           name="mark">
</div>

<div class="form-group">
    <label for="subject_id">Предмет</label>
    <select class="form-control" id="subject_id" name="subject_id" required>
        @foreach($subjectsList as $subject)
            <option value="{{ $subject->id }}" @selected($subject->id == old('subject_id', $subject->id))>
                {{ $subject->name }}
            </option>
        @endforeach
    </select>
</div>



