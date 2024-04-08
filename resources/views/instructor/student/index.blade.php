@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="customerTable" class="table">
            <thead>
            <tr>
                <th scope="col">naam</th>
                <th scope="col">adres</th>
                <th scope="col">postcode</th>
                <th scope="col">woonplaats</th>
                <th scope="col">telefoon</th>
                <th scope="col">email</th>
                <th scope="col">Les tegoed</th>
                <th scope="col">Acties</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($students as $student)
                @php
                    // count how many lessons the current student has remaining
                    $remainingLessons = 0;
                    foreach($student->stripCards as $stripCard){
                        $remainingLessons += $stripCard->remaining;
                    }
                @endphp
                <tr>
                    <td>{{ $student->first_name }} {{ $student->sir_name }}</td>
                    <td>{{ $student->address}}</td>
                    <td>{{ $student->zipcode}}</td>
                    <td>{{ $student->city}}</td>
                    <td>{{ $student->phone}}</td>
                    <td>{{ \Illuminate\Support\Str::limit($student->email, 20, '...') }}</td>
                    <td>{{ $remainingLessons }}</td>
                    <td>
                        <a href="{{ route('instructor.student.edit', ['id' => $student->id]) }}" class="btn btn-primary">Inzien</a>
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
