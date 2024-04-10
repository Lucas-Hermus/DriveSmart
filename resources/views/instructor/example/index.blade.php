@extends("instructor.components.main")

@section("content")
    <div class="overflow-auto">
        <table id="dataTable-table" class="table">
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
            $('#dataTable-table').DataTable({
                order: [[2, 'asc']],
                language: {
                    url: '{{ asset('instructor-public/language/datatable.json') }}',
                },
            });
        });
    </script>

@endsection
