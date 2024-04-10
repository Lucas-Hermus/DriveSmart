@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="dataTable-table" class="table">
            <thead>
            <tr>
                <th scope="col">leerling</th>
                <th scope="col">resterende lessen</th>
                <th scope="col">acties</th>
            </tr>
            </thead>
            <tbody>
            {{--show all stripcards--}}
            @foreach ($stripCards as $stripCard)
                <tr>
                    <td>{{ $stripCard->student->first_name }} {{ $stripCard->student->sir_name }}</td>
                    <td>{{ $stripCard->remaining }} van de {{ $stripCard->lessons }}</td>
                    <td>
{{--                        route to the edit page--}}
                        <a href="{{ route('instructor.strip_card.edit', ['id' => $stripCard->id]) }}"
                           class="btn btn-primary">Beheren</a>

                        <a onclick="deleteStripCard({{$stripCard->id}})" class="btn btn-danger">Verwijderen</a>
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

        // send a put request to soft delete a stipcard
        function deleteStripCard(id) {
            axios.put(`/instructor/api/strip-card/delete/${id}`)
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error)
                });
        }
    </script>

@endsection
