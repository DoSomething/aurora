<ul class="gallery -duo">
  @foreach($keys as $key)
    <li>
      <article class="figure -left">
          <div class = "well" >
           <dt class="control-label col-sm-2"><strong> App ID: </strong> {{ $key['app_id'] }} </dt>
           <dt class="control-label col-sm-2"><strong> API Key: </strong>{{ $key['api_key'] }} </dt>
          </div>
      </article>
    </li>
  @endforeach
</ul>