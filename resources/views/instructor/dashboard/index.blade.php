@extends("instructor.components.dashboard")

@section("content")
    <div class="overflow-auto">
        <h1>Welkom bij DriveSmart</h1>


        <div style="max-width: 100%" class="row g-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    Bij DirveSmart leer je rijden op het tempo dat bij jouw past.<br>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table table-bordered" style="width:100%;">
                    <thead class="thead">
                    <th>Dag</th>
                    <th>Tijden</th>
                    </thead>
                    <tbody class="table table-striped">
                    <tr>
                        <td>Monday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Friday
                        </td<>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    <tr>
                        <td>Sunday</td>
                        <td>9:00 AM - 5:00 PM</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
