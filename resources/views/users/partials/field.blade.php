<dt>{{ $label or title_case($field) }}:</dt>
@if ($user->{$field})
    <dd>{{ $user->{$field} }}</dd>
@else
    <dd>&mdash;</dd>
@endif
