<ul class="gallery -triad " data-show-more="true">
	@forelse ($campaigns as $campaign)
		<li>
	    <div class="figure">
	      <div class="figure__media">
					<img src= "{{ $campaign['cover_image']['default']['uri'] }}">
				</div>
				<div class="figure__body">
					<b>{{ $campaign['title'] }}</b>
				</div>
			</div>
		</li>
	@empty
		<h3>This user has no campaigns</h3>	
	@endforelse
</ul>