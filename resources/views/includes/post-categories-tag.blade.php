@if(count($postCats) > 0)
<div class="">
             <div class="d-flex align-items-center mb-2">
            <div class="flex-shrink-0">
            <a href="javascript:void(0)" class="btn-left btn-link p-2 toggle-cat-items text-dark"><i class="fa fa-chevron-left"></i></a>
            </div>
            <div class="flex-grow-1 w-100 overflow-hidden">
            <ul class="nav nav-fill text-uppercase small position-relative flex-nowrap cat-nav-list">
                <li class="nav-item">
                    <a href="{{isset($url2) ? $url2 : url(request()->path())}}" data-cat="all" class="nav-link filter">All</a>
                </li>
                @foreach($postCats as $postCat)
                <li class="nav-item position-relative">
                    <a href="{{isset($url2) ? $url2 : url(request()->path())}}" data-cat="{{$postCat->value}}" class="nav-link filter">
                        ({{\App\Models\Updates::where('cat_post', $postCat->value)->where('user_id', $user->id)->count()}})
                        {{$postCat->value}}
                        </a>
                        
                </li>
                @endforeach
            </ul>
            </div>
            <div class="flex-shrink-0">
            <a href="javascript:void(0)" class="btn-right btn-link toggle-cat-items p-2 text-dark"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        </div>
@endif