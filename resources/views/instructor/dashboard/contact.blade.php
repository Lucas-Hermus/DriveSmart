@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="customerTable" class="table">
            <thead>
            <tr>
                <th scope="col">naam</th>
                <th scope="col">naam</th>
            </tr>
            </thead>
            <tbody>

            {{--            @foreach ($tickets as $ticket)--}}
            <tr>
                <td>{{ "aa" }}</td>
                <td>{{ "aa" }}</td>
                {{--                    <td>{{ $ticket->product->name }}</td>--}}
            </tr>
            {{--            @endforeach--}}
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
