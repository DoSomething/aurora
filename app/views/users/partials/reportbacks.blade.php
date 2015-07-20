<ul class="gallery -triad " data-show-more="true">
	@forelse ($reportbacks as $reportback)
		<li>
	    <div class="figure">
	      <div class="figure__media">
					@if (!empty($reportback['reportback_items']['data']['0']['media']['uri']))
						<img src= "{{{ $reportback['reportback_items']['data']['0']['media']['uri'] }}}">
					@endif
				</div>
				<div class="figure__body">
					<p><b>Campaign: {{{ $reportback['campaign']['title'] }}}</b></p>
					<b>Quantity:</b> {{{ $reportback['quantity'] }}}
				</div>
			</div>
		</li>
	@empty
		<h3>This user has no reportbacks</h3>
	@endforelse
</ul>
