@extends('layout.master')

@section('main_content')

@include('layout.header', ["header" => "Admin Index", "subtitle" => "Listing of all admins"])
<ul class="gallery -duo">
  @forelse($admins as $admin)
    <li>
      <article class="figure -left admin-profile">
        <dl class="profile-settings">
          <dt>Id:</dt><dd>{{{ $admin['_id'] }}}</dd>
          {{ isset($admin['drupal_id']) ? ('<dt>Drupal Id:</dt><dd>' . e($admin['drupal_id']) . '</dd>') : "" }}
          {{ isset($admin['first_name']) ? ('<dt>First Name:</dt><dd>' . e($admin['first_name']) . '</dd>') : "" }}
          {{ isset($admin['last_name']) ? ('<dt>Last Name:</dt><dd>' . e($admin['last_name']) . '</dd>') : "" }}
          {{ isset($admin['email']) ? ('<dt>Email:</dt><dd>' . e($admin['email']) . '</dd>') : "" }}
          {{ isset($admin['mobile']) ? ('<dt>Mobile:</dt><dd>' . e($admin['mobile']) . '</dd>') : "" }}
          {{ isset($admin['mobile']) ? ('<dt>Mobile:</dt><dd>' . e(sanitizePhoneNumber($admin['mobile'], isset($admin['country']) ? $admin['country'] : "")) .'</dd>')  : '' }}</td>
          {{ isset($admin['birthdate']) ? ('<dt>Birthday:</dt><dd>' . e($admin['birthdate']) . '</dd>') : "" }}
          @if (isset($admin['addr_street1']) || isset($admin['addr_street2']) || isset($admin['add_city']) || isset($admin['addr_state']) || isset($admin['addr_zip']) )
            <dt>Address:</dt><dd>{{{ $admin['addr_street1'] or '' }}} {{{ $admin['addr_street2'] or '' }}} {{{ $admin['add_city'] or '' }}} {{{ $admin['addr_state'] or '' }}} {{{ $admin['addr_zip'] or '' }}}</dd>
          @endif
          {{ isset($admin['country']) ? ('<dt>Country:</dt><dd>' . e($admin['country']) . '</dd>') : "" }}
        </dl>
      </article>
    </li>
  @empty
    There is no admin admin
  @endforelse
</ul>
@stop
