@if (count($errors) > 0)
    <div id="error_explanation">
        <div class="alert alert-error">
            The form contains {{ Html::pluralize(count($errors), "error") }}.
        </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>* {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
