<dt>SMS Status:</dt><dd>{{ $user->sms_status or '&mdash;' }}</dd>
<dt>SMS Paused:</dt><dd>{{ $user->sms_paused ? '✔' : '✘' }}</dd>
<dt>Email Subscription Status:</dt><dd>{{ $user->email_subscription_status ? '✔' : '✘' }}</dd>
<dt>Email Subscription Topics:</dt><dd>{{ $user->email_subscription_topics ? implode(",  ",$user->email_subscription_topics) : '&mdash;'}}</dd>