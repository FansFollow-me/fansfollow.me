<select name="cat_post" class="js-example-tags form-control w-100">
                 <option value="">-Select Category-</option>
                 @foreach($postCats as $postCat)
                 <option value="{{$postCat->value}}">{{$postCat->value}}</option>
                 @endforeach
                </select>