<dt>{{ $label or title_case($field) }}:</dt>
@if (str_contains(request()->query('include'), $field))
    <dd class="revealed">{{ $user->{$field} }} {{ revealer($field) }}
@elseif ($user->{$preview_field})
    <dd>{{ $user->{$preview_field} }}{{ $preview_suffix or '' }} {{ revealer($field) }}</dd>
@else
    <dd>&mdash;</dd>
@endif
