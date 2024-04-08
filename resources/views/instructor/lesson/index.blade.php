@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="customerTable" class="table">
            <thead>
            <tr>
                <th scope="col">instructeur</th>
                <th scope="col">leerling</th>
                <th scope="col">auto</th>
                <th scope="col">datum</th>
                <th scope="col">start</th>
                <th scope="col">einde</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->instructor?->first_name ?? "n.b.t." }} {{ $lesson->instructor?->last_name }}</td>
                    <td>{{ $lesson->student?->first_name ?? "n.b.t." }} {{ $lesson->student?->last_name }}</td>
                    <td>{{ $lesson->car?->plate ?? "n.b.t."}}</td>
                    <td>{{ \Carbon\Carbon::parse($lesson->start)->format("d-m-Y d-m-Y")}}</td>
                    <td>{{ \Carbon\Carbon::parse($lesson->start)->format("H:i")}}</td>
                    <td>{{ \Carbon\Carbon::parse($lesson->end)->format("H:i")}}</td>
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
