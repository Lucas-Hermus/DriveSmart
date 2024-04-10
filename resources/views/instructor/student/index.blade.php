@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="dataTable-table" class="table">
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
                <tr>
                    <td>{{ $student->first_name }} {{ $student->sir_name }}</td>
                    <td>{{ $student->address}}</td>
                    <td>{{ $student->zipcode}}</td>
                    <td>{{ $student->city}}</td>
                    <td>{{ $student->phone}}</td>
                    <td>{{ \Illuminate\Support\Str::limit($student->email, 20, '...') }}</td>
                    <td>{{ $student->calcuateStripCardBalance() }}</td>
                    <td>
                        <a href="{{ route('instructor.student.show', ['id' => $student->id]) }}" class="btn btn-primary">Inzien</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        // init the datatable
        $(document).ready(function () {
            $('#dataTable-table').DataTable({
                language: {
                    url: '{{ asset('instructor-public/language/datatable.json') }}', // set the language to dutch
                },
            });
        });
    </script>

@endsection
