@extends("instructor.components.main")

@section("content")
    <h1>Product aanmaken</h1>
{{--    raction="{{route('adminportal.api.product.store')}}"--}}
    <form method="post" data-handle-errors>
        @csrf
        @method('post')
        <div class="mb-3">
            <label class="form-label">Productnaam</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Fire Arcade"
                   data-error-message="Geef een productnaam op">
        </div>
        <div class="mb-3">
            <label class="form-label">Serienummer</label>
            <input type="text" class="form-control" id="number" name="serial" placeholder="123456789"
                   data-error-message="Geef een geldig serienummer op">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Opslaan">
        </div>
    </form>
    @if(count($errors))
        <div id="form-submit-fail" class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
@endsection

@section('scripts')
@endsection
