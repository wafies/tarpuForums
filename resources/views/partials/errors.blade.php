@if ($errors->any())
    <div class="alert-error">
        <strong>Izlabojiet kļūdas:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
