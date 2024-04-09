@extends("instructor.components.main")

@section("content")

    <h1>Les beheren</h1>
    <form >
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">naam</label>
                <input type="text" disabled class="form-control" value="{{$student->first_name}} {{$student->sir_name}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">adres</label>
                <input type="text" disabled class="form-control" value="{{$student->address}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">postcode</label>
                <input type="text" disabled class="form-control" value="{{$student->zipcode}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">woonplaats</label>
                <input type="text" disabled class="form-control" value="{{$student->city}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">telefoon</label>
                <input type="text" disabled class="form-control" value="{{$student->phone}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">postcode</label>
                <input type="text" disabled class="form-control" value="{{$student->email}}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Strippenkaart tegoed</label>
                <input type="text" disabled class="form-control" value="{{$student->calcuateStripCardBalance()}}">
            </div>
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
@endsection

@section('scripts')
@endsection
