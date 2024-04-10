@extends("instructor.components.main")

@section("content")
    <h1>Strippenkaart aanmaken</h1>
    <form method="post" data-handle-errors action="{{route('instructor.api.strip_card.store')}}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Aantal lessen</label>
            <input type="number" class="form-control" id="name" name="lessons" placeholder="10"
                   data-error-message="Kies het aantal lessen.">
        </div>
        <label class="form-label">Leerling</label>
        <select name="student_id" id="student_id" class="form-select" data-error-message="Selecteer een Leerling">
            <option selected disabled value="">Leerling</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}"> {{ $student->first_name}} {{ $student->sir_name}}</option>
            @endforeach
        </select>
        <br>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Opslaan">
        </div>
    </form>
{{--    show the first error--}}
    @if(count($errors))
        <div id="form-submit-fail" class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
@endsection

@section('scripts')
@endsection
