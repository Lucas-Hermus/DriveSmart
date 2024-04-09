@extends("instructor.components.main")

@section("content")
    @if(Route::currentRouteName() == "instructor.lesson.personal")
        <h1>Weekoverzicht</h1>
    @else
        <h1>Mijn lessen</h1>
    @endif
    <div class="overflow-auto">
        <table id="customerTable" class="table">
            <thead>
            <tr>
                <th scope="col">leerling</th>
                <th scope="col">auto</th>
                <th scope="col">datum</th>
                <th scope="col">start</th>
                <th scope="col">einde</th>
                <th scope="col">status</th>
                <th scope="col">acties</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($lessons as $lesson)
                @php $badgeColor = $lesson->completed ? "success" : "secondary" @endphp
                <tr>
                    <td>{{ $lesson->student?->first_name ?? "n.b.t." }} {{ $lesson->student?->sir_name }}</td>
                    <td>{{$lesson->car->brand}} {{$lesson->car->model}} ({{$lesson->car->plate}})</td>
                    <td>{{ \Carbon\Carbon::parse($lesson->start)->format("d-m-Y")}}</td>
                    <td>{{ \Carbon\Carbon::parse($lesson->start)->format("H:i")}}</td>
                    <td>{{ \Carbon\Carbon::parse($lesson->end)->format("H:i")}}</td>
                    @if($lesson->completed)
                        <td><span class="badge bg-success">Voltooid</span></td>
                    @else
                        <td><span class="badge bg-secondary">Ingepland</span></td>
                    @endif
                    <td>
                        <a href="{{ route('instructor.lesson.edit', ['id' => $lesson->id]) }}" class="btn btn-primary">Beheren</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('#customerTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Dutch.json"
                }
            });
        });
    </script>

@endsection
