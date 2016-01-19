<ul class="gallery -triad " data-show-more="true">
	@forelse ($campaigns as $campaign)
		<li>
	    <div class="figure">
	      <div class="figure__media">
					@if (isset($campaign['cover_image']['default']['uri']))
						<img src="{{ e($campaign['cover_image']['default']['uri']) }}" />
					@else
						<img src="{{ asset('assets/images/campaign-placeholder.png') }}" style="width:288px;height:288px;" />
					@endif
				</div>
				<div class="figure__body">
					<b>{{ isset($campaign['title']) ? e($campaign['title']) : "Not an actual campaign" }}</b>
				</div>
			</div>
		</li>
	@empty
		<p>This user has no campaigns.</p>
	@endforelse
</ul>
