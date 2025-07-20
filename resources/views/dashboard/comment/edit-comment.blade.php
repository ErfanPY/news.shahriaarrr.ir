<x-layouts.dashboard>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">ویرایش نظر</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('dashboard.comments.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="content" class="form-label">متن نظر</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" rows="5" required>{{ old('content', $comment->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">پست مربوطه</label>
                                <div class="border p-2 rounded bg-light">
                                    <a href="{{ route('post.show', $comment->post_id) }}" class="text-decoration-none">
                                        <h5>{{ $comment->post->name }}</h5>
                                    </a>
                                    <p class="text-muted small mb-0">ارسال شده توسط: {{ $comment->user->name }}</p>
                                </div>
                              </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('dashboard.comments') }}" class="btn btn-outline-secondary me-md-2">
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