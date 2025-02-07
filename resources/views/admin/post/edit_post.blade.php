@extends('admin.master')
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="card">
        <div class="card-header">
          <h5>Cập nhật</h5>
        </div>
        <div class="card-block">
          <form class="mb-3 row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label col-form-label">Tiêu đề</label>
                <input type="text" class="form-control fill" id="title"
                  name="title" value="{{ $post->title }}">
              </div>
              <div class="row">
                <div class="mb-3 col">
                  <label class="form-label col-form-label">Giá</label>
                  <div class="">
                    <input type="text" class="form-control fill" id="price"
                      name="price" value="{{ $post->price }}">
                  </div>
                </div>
                <div class="mb-3 col">
                  <label class="form-label col-form-label">Diện tích</label>
                  <div class="">
                    <input type="text" class="form-control fill" id="area"
                      name="area" value="{{ $post->area }}">
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Danh mục</label>
                <select class="border form-select form-control fill"
                  name="category">
                  <option disabled selected>Chọn danh mục</option>
                  @foreach ($categories as $cat)
                    <option {{ $post->category_id == $cat->id ? 'selected' : '' }}
                      value="{{ $cat->id }}">{{ $cat->category_name }}
                    </option>
                  @endforeach
                </select>
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Mô tả</label>
                <div class="">
                  <textarea name="description" class="form-control max-textarea" maxlength="255"
                    rows="4" style="height: 102px;">{{ $post->description }}</textarea>
                  <p></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3 ">
                <div class="mb-3 has-success">
                  <label class="form-label col-sm-2">Trạng thái</label>
                  <div class="col">
                    <div class="form-radio">
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input
                            {{ $post->status == 'approved' ? 'checked' : '' }}
                            type="radio" name="status" value="approved">
                          <i class="helper"></i>Đã duyệt
                        </label>
                      </div>
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input {{ $post->status == 'pending' ? 'checked' : '' }}
                            type="radio" name="status" value="pending">
                          <i class="helper"></i>Chờ duyệt
                        </label>
                      </div>
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input
                            {{ $post->status == 'rejected' ? 'checked' : '' }}
                            type="radio" name="status" value="rejected">
                          <i class="helper"></i>Hủy bỏ
                        </label>
                      </div>
                      <div class="radio radiofill radio-primary radio-inline">
                        <label class="form-label">
                          <input {{ $post->status == 'hidden' ? 'checked' : '' }}
                            type="radio" name="status" value="hidden">
                          <i class="helper"></i>Ẩn
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="checkbox-fade fade-in-primary">
                  <label class="form-label">
                    <input {{ $post->is_featured == 1 ? 'checked' : '' }}
                      name="is_featured" type="checkbox" value="1">
                    <span class="cr">
                      <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span>
                    <span>Đặc trưng</span>
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Tỉnh/ Thành
                  phố</label>
                <select class="border form-select form-control fill"
                  name="city">
                  <option selected>Chọn Tỉnh/ Thành phố</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Quận/ Huyện</label>
                <select class="border form-select form-control fill"
                  name="district">
                  <option selected>Chọn Quận/ Huyện</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Phường/ Xã</label>
                <select class="border form-select form-control fill"
                  name="ward">
                  <option selected>Chọn Phường/ Xã</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
                <p></p>
              </div>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
