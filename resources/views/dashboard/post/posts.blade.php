<x-layouts.dashboard>
  <div class="container">
      <h1 class="mb-4">پست ها</h1>

      <div class="mb-3">
          <a href="{{ route('dashboard.create-post') }}" class="btn btn-primary">ساختن پست جدید</a>
      </div>

      <div class="table-responsive">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>ردیف</th>
                      <th>نام</th>
                      <th>دسته بندی</th>
                      <th>وضعیت</th>
                      <th>تاریخ ساخت</th>
                      <th>مدیریت</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse($posts as $post)
                      <tr>
                          <td>{{ $post->id }}</td>
                          <td>
                              <a href="{{ route('dashboard.edit-post', $post->id) }}">
                                  {{ $post->name }}
                              </a>
                          </td>
                          <td>{{ $post->category->name ?? 'Uncategorized' }}</td>
                          <td>
                              <span class="badge 
                                  @if($post->status == 'accepted') bg-success 
                                  @elseif($post->status == 'rejected') bg-danger 
                                  @else bg-warning text-dark @endif">
                                  {{ ucfirst($post->status) }}
                              </span>
                          </td>
                          <td>{{ $post->created_at_jalali }}</td>
                          <td>
                              <a href="{{ route('dashboard.edit-post', $post->id) }}" class="btn btn-sm btn-outline-primary">ویرایش</a>
                              <form action="{{ route('dashboard.posts.delete', $post->id) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">حذف</button>
                              </form>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="7" class="text-center">شما هنوز پستی نساختید.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
</x-layouts.dashboard>