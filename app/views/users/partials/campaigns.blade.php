<ul class="gallery -triad " data-show-more="true">
	@forelse ($campaigns as $campaign)
		<li>
	    <div class="figure">
	      <div class="figure__media">
					{{ isset($campaign['cover_image']['default']['uri']) ? ('<img src=' . e($campaign['cover_image']['default']['uri']) . '>') : '<img src='. (asset('assets/images/campaign-placeholder.png')) .'>' }}
				</div>
				<div class="figure__body">
					<b>{{ isset($campaign['title']) ? e($campaign['title']) : "Not an actual campaign" }}</b>
				</div>
			</div>
		</li>
	@empty
		<h3>This user has no campaigns</h3>
	@endforelse
</ul>
