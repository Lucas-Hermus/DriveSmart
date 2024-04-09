@extends("instructor.components.dashboard")

@section("content")
    <div class="overflow-auto">
        <h1>Contact</h1>
        <div class="card">
            <div class="card-body">
                Wij zijn tijdens onze werktijden bereikbaar op het telefoonummer: <b>06-12345678</b>
                U kunt ons ook een mail suren via <a href="mailto: DriveSmart@gmail.com">DriveSmart@gmail.com</a>. Of stel direct een vraag via het formulier:
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <form method="post" data-handle-errors action="{{route('api.contact')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Uw naam*</label>
                        <input type="text" class="form-control" id="name" name="name"
                               data-error-message="Vul een naam in">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email adress*</label>
                        <input type="text" class="form-control" id="email" name="email"
                               data-error-message="Vul een naam in">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vraag/opmerking*</label>
                        <textarea id="text" name="text" rows="4" class="form-control" style="resize: none" placeholder="Type hier uw vraag" data-error-message="type een vraag of opmerking"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Opslaan">
                    </div>
                    @if(count($errors))
                        <div id="form-submit-fail" class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </form> </div>
        </div>

    </div>
@endsection
