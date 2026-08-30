<div class="modal fade introVidModal" id="introVidModal{{$response->username}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
		<div class="modal-header border-bottom-0">
			<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					<i class="bi bi-x-lg"></i>
				</span>
			</button>
		</div>
        <div class="modal-body">
          <video  data-type="post-" src="{{ Helper::getFile(config('path.introvideo').$response->intro_video) }}"  disableRemotePlayback  class="video-js @if (request()->ajax()) video-js-ajax @endif  vjs-fluid" id="player_post_{{$response->id}}">
		<source src="{{ Helper::getFile(config('path.introvideo').$response->intro_video) }}" type="video/mp4" />
	</video>
      </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->