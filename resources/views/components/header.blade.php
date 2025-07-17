
    @foreach ($headCats as $cat)
        <li class="nav-item">
            <a href="{{ route('cat.show',$cat->id) }}" class="nav-link ">{{$cat->name}}</a>
        </li>
    @endforeach


