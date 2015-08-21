@extends('layout.master')

@section('main_content')

@include('layout.header', ['header' => 'Mobile Commons Messages', 'subtitle' => 'Backlog of all texts'])

<div class ="container -padded">
  <div class="wrapper">
	  <div class="container__block">
	  	@forelse($messages as $message)
				<div class="mobile-commons-message {{ message_state_class($message['@attributes']['status']) }}" >
			  	<ul class="gallery -duo">
			  		<li>
				  		<article class="figure -left">
								<div class="container__block">
									<dl class="profile-settings">
							  		<dt>Status: </dt><dd>{{{ $message['@attributes']['status'] }}}</dd>
							  		<dt>Message Type:	</dt><dd>{{{ $message['@attributes']['message_type'] }}}</dd>
                     @If(isset($message['campaign']))
                    <?php $campaign = $message['campaign'] ?>
                    @else
                    <?php $campaign = $message['mdata'] ?>
                    @endif
							  		<dt>Campaign: </dt><dd>{{ link_to('https://secure.mcommons.com/campaigns/' . $campaign['@attributes']['id'], $campaign['name']) }}</dd>
							  		<dt>Campaign ID: </dt><dd>{{{ $campaign['@attributes']['id'] }}}</dd>
							  		<dt>Active?: </dt><dd>{{{ $campaign['@attributes']['active'] }}}</dd>
							  		<dt>Sent On: </dt><dd>{{{ time_formatter($message['when']), true }}}</dd>
									</dl>
					  		</div>
				  		</article>
			  		</li>
			  		<li>
			  			<article class="figure -left">
				  			<div class="container__block">
					  			<dl class="profile-settings">
							  		<dt>Content: </dt><dd>{{{ !empty($message['body']) ? $message['body'] : "" }}}</dd>
                    <!-- if ($message['@attributes']['status'] != 'failed_permanently' && $message['@attributes']['status'] != 'sent' ) -->
                    <!-- conditional above is to make opt_in_path_link to MobileCommons only appear for user sent messages -->
                      @if (!empty($opt_in_path_ids[$campaign['@attributes']['id']] ))
                      <dt>Involved Opt In Path Id:</dt>
                      <?php $campaign_id = array_search($opt_in_path_ids[$campaign['@attributes']['id']], $opt_in_path_ids)?>
                        @foreach( array_unique($opt_in_path_ids[$campaign['@attributes']['id']]) as $opt_in_path_id )
                          <dt>{{  link_to('https://secure.mcommons.com/campaigns/'. $campaign_id . '/opt_in_paths/' . $opt_in_path_id, $opt_in_path_id)  }}</dt>
                        @endforeach
                      @endif
                    <!-- endif -->
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
