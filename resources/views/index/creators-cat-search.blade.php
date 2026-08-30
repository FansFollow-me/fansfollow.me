<div class="row">

              @foreach($users as $response)
              <div class="col-md-6 mb-4">
                @include('includes.listing-creators')
              </div><!-- end col-md-4 -->
              @endforeach

              @if($users->lastPage() > 1)
                <div class="w-100 d-block">
                  {{ $users->onEachSide(0)->links() }}
                </div>
              @endif
            </div><!-- row -->