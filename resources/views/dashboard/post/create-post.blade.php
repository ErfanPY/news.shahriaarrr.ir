<x-layouts.dashboard>
  <div class="container py-4">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card shadow-sm">
                  <div class="card-header bg-primary text-white">
                      <h4 class="mb-0">ایجاد پست جدید</h4>
                  </div>

                  <div class="card-body">
                      <form action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                              <label for="name" class="form-label">عنوان پست</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                              @error('name')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="body" class="form-label">محتوا</label>
                              <textarea class="form-control @error('body') is-invalid @enderror" 
                                        id="body" name="body" rows="6" required>{{ old('body') }}</textarea>
                              @error('body')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="category_id" class="form-label">دسته بندی</label>
                              <select class="form-select @error('category_id') is-invalid @enderror" 
                                      id="category_id" name="category_id">
                                  <option value="">بدون دسته بندی</option>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                          {{ $category->name }}
                                      </option>
                                  @endforeach
                              </select>
                              @error('category_id')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="url" class="form-label">لینک خارجی (اختیاری)</label>
                              <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                    id="url" name="url" value="{{ old('url') }}">
                              @error('url')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="image" class="form-label">تصویر شاخص (اختیاری)</label>
                              <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image" accept="image/*">
                              @error('image')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>

                          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                              <a href="{{ route('dashboard.posts') }}" class="btn btn-outline-secondary me-md-2">
                                  <i class="bi bi-arrow-right"></i> انصراف
                              </a>
                              <button type="submit" class="btn btn-primary">
                                  <i class="bi bi-save"></i> ذخیره پست
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-layouts.dashboard>