@extends("instructor.components.main")

@section("content")

    <h1>Les beheren</h1>
    <form method="post" data-handle-errors action="{{ route('instructor.api.lesson.update', ['id' => $lesson->id]) }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Leerling</label>
                <input type="text" disabled class="form-control" value="{{$lesson->student->first_name}} {{$lesson->student->sir_name}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Strippenkaart tegoed</label>
                <input type="text" disabled class="form-control" value="{{$lesson->student->calcuateStripCardBalance()}}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Adres</label>
            <input type="text" disabled class="form-control" value="{{$lesson->student->address}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Auto</label>
            <input type="text" disabled class="form-control" value="{{$lesson->car->brand}} {{$lesson->car->model}} {{$lesson->car->plate}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Datum</label>
            <input type="text" disabled class="form-control" value="{{ \Carbon\Carbon::parse($lesson->start)->format("d-m-Y")}}">
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">start</label>
                <input type="datetime-local" disabled class="form-control" value="{{ \Carbon\Carbon::parse($lesson->start)}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">start tijd</label>
                <input type="datetime-local" disabled class="form-control" value="{{ \Carbon\Carbon::parse($lesson->end)}}">
            </div>
        </div>
        <br>
        <label class="form-label">Les verslag</label>
        <textarea {{$lesson->completed ? "disabled" : ""}} id="report" name="report" rows="4" class="form-control" style="resize: none" placeholder="Les verslag">{{$lesson->report}}</textarea>
        <br>
        <div class="mb-3">
            @if(!$lesson->completed)
                <input type="submit" class="btn btn-primary" value="Opslaan">
                <a class="btn btn-success" onclick="finishLesson({{$lesson->id}})">Voltooien</a>
            @endif
        </div>
        <script>
            function finishLesson(id) {
                axios.put(`/instructor/api/lesson/finish/${id}`)
                    .then(response => {
                        window.location.reload();
                    })
                    .catch(error => {
                        console.log(error)
                    });
            }
        </script>
    </form>
    @if(count($errors))
        <div id="form-submit-fail" class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
@endsection

@section('scripts')
@endsection
