<x-layouts.dashboard>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">ویرایش وضعیت نظر</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('dashboard.posts.comments.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">متن نظر</label>
                                <div class="border p-3 rounded bg-light">
                                    {{ $comment->content }}
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">پست مربوطه</label>
                                <div class="border p-2 rounded bg-light">
                                    <a href="{{ route('post.show', $comment->post_id) }}" class="text-decoration-none">
                                        <h5>{{ $comment->post->name }}</h5>
                                    </a>
                                    <p class="text-muted small mb-0">ارسال شده توسط: {{ $comment->user->name }}</p>
                                    <p class="text-muted small">تاریخ: {{ {{ $comment->created_at_jalali }} }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">تغییر وضعیت نظر</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" 
                                           id="status-pending" value="pending" {{ old('status', $comment->status) == 'pending' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status-pending">
                                        در انتظار بررسی
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" 
                                           id="status-accepted" value="accepted" {{ old('status', $comment->status) == 'accepted' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status-accepted">
                                        تایید شده
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" 
                                           id="status-rejected" value="rejected" {{ old('status', $comment->status) == 'rejected' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status-rejected">
                                        رد شده
                                    </label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('dashboard.author.comments') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="bi bi-arrow-right"></i> انصراف
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> ذخیره تغییرات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>