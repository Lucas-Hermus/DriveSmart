@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="customerTable" class="table">
            <thead>
            <tr>
                <th scope="col">leerling</th>
                <th scope="col">resterende lessen</th>
                <th scope="col">acties</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($stripCards as $stripCard)
                <tr>
                    <td>{{ $stripCard->student->first_name }} {{ $stripCard->student->sir_name }}</td>
                    <td>{{ $stripCard->remaining }} van de {{ $stripCard->lessons }}</td>
                    <td>
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
        $(document).ready(function () {
            $('#customerTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Dutch.json"
                }
            });
        });

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
