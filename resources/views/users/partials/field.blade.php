<dt>{{ $label ?? Str::title($field) }}:</dt>
<dd>{{ $user->{$field} ?? '&mdash;' }}</dd>
