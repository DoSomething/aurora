@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Mobile Commons Messages', 'subtitle' => 'Backlog of all texts'])

<div class ="container -padded">
  <div class="wrapper">
	  <div class="container__block">
	  	@forelse($mc_messages as $message)
				<div class="mobile-commons-message {{ message_state_class($message['@attributes']['status']) }}" >
			  	<ul class="gallery -duo">
			  		<li>
				  		<article class="figure -left">
								<div class="container__block">
									<dl class="profile-settings">
							  		<dt>Status: </dt><dd>{{{ $message['@attributes']['status'] }}}</dd>
							  		<dt>Message Type:	</dt><dd>{{{ $message['@attributes']['message_type'] }}}</dd>
							  		<dt>Campaign: </dt><dd>{{{ $message['campaign']['name'] }}}</dd>
							  		<dt>Campaign ID: </dt><dd>{{{ $message['campaign']['@attributes']['id'] }}}</dd>
							  		<dt>Active?: </dt><dd>{{{ $message['campaign']['@attributes']['active'] }}}</dd>
							  		<dt>Sent On: </dt><dd>{{{ time_formatter($message['when']), true }}}</dd>
									</dl>
					  		</div>
				  		</article>
			  		</li>
			  		<li>
			  			<article class="figure -left">
				  			<div class="container__block">
					  			<dl class="profile-settings">
							  		<dt>Content: </dt><dd>{{{ $message['body'] }}}</dd>
					  			</dl>
				  			</div>
			  			</article>
			  		</li>
			  	</ul>
				</div>
	  	@empty
	  		<h3>This user has no messages</h3>
	  	@endforelse				
		</div>
  </div>
</div>

@stop
