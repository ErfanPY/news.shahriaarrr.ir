<x-layouts.dashboard>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>نظرات پست ها </h2>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>محتوا</th>
                                <th>پست مربوطه</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td class="text-truncate" style="max-width: 200px;">{{ Str::limit($comment->content, 50) }}</td>
                                    <td>
                                        <a href="{{ route('post.show', $comment->post_id) }}">
                                            {{ Str::limit($comment->post->name, 30) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($comment->status == 'accepted') bg-success
                                            @elseif($comment->status == 'rejected') bg-danger
                                            @else bg-warning text-dark @endif">
                                            @if($comment->status == 'pending') در انتظار
                                            @elseif($comment->status == 'accepted') تایید شده
                                            @else رد شده @endif
                                        </span>
                                    </td>
                                    <td>{{ $comment->created_at_jalali }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('dashboard.posts.comments.edit', $comment->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                               ویرایش
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">هنوز نظری برای پست‌های شما ثبت نشده است</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-layouts.dashboard>