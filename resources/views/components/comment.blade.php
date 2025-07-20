@auth
    <form action="{{ route('dashboard.comments.store', $post) }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <textarea 
                name="content" 
                class="form-control" 
                rows="3" 
                placeholder="نظر خود را بنویسید..."
                required
            ></textarea>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">ارسال نظر</button>
        </div>
    </form>
@else
    <div class="alert alert-info mt-4">
        برای ارسال نظر لطفا <a href="{{ route('login') }}">وارد شوید</a>.
    </div>
@endauth