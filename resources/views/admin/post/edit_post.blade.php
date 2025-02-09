@extends('admin.master')
@section('customCss')
  <link href="{{ asset('admin/trumbowyg/trumbowyg.min.css') }}" rel="stylesheet"
    type="text/css" id="app-style" />
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <div class="card">
        <div class="card-header">
          <h5>Cập nhật</h5>
        </div>
        <div class="card-block">
          <form method="POST" action="{{ route('admin.storeUpdate.Post') }}"
            class="mb-3 row">
            @csrf
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
                  name="province" id="province">
                  <option selected disabled>Chọn Tỉnh/Thành phố</option>
                </select>
                {{-- <input type="hidden" id="province_name" name="province_name"> --}}
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Quận/Huyện</label>
                <select class="border form-select form-control fill"
                  name="district" id="district">
                  <option selected="" disabled>Chọn Quận/Huyện</option>
                </select>
                {{-- <input type="hidden" id="district_name" name="district_name"> --}}
                <p></p>
              </div>
              <div class="mb-3">
                <label class="form-label col-form-label">Phường/Xã</label>
                <select class="border form-select form-control fill"
                  name="ward" id="ward">
                  <option selected="" disabled>Chọn Phường/Xã</option>
                </select>
                {{-- <input type="hidden" id="ward_name" name="ward_name"> --}}
                <p></p>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label class="form-label col-form-label">Mô tả</label>
                <textarea name="description" class="form-control max-textarea description"
                  maxlength="255" rows="4" style="height: 102px;">{{ $post->description }}</textarea>
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
@section('customJs')
  <script>
    async function fetchData(A, B) {
      const url = `https://esgoo.net/api-tinhthanh/${A}/${B}.htm`;
      try {
        const response = await fetch(url);
        if (!response.ok) {
          console.log(`HTTP error ! Status: ${response.status}`);
        }
        const data = response.json();
        return data;
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }
    document.addEventListener("DOMContentLoaded", async () => {
      const provinceSelect = document.getElementById("province");
      const districtSelect = document.getElementById("district");
      const wardSelect = document.getElementById("ward");
      // Load provinces
      try {
        const provinces = await fetchData(1, 0);
        provinces.data.forEach((province) => {
          const option = document.createElement("option");
          option.value = province.name;
          option.setAttribute("data-province_id", province.id);
          option.textContent = province.name;
          provinceSelect.appendChild(option);
        });
      } catch (error) {
        console.error("Error loading provinces:", error);
      }
      // Load districts when a province is selected
      provinceSelect.addEventListener("change", async () => {
        districtSelect.innerHTML =
          "<option disabled selected value=''>Chọn Quận/Huyện</option>";
        wardSelect.innerHTML =
          "<option disabled selected value=''>Chọn Phường/Xã</option>";
        if (provinceSelect.value) {
          const province_id = provinceSelect
            .querySelector("option:checked")
            .getAttribute("data-province_id");
          try {
            const districts = await fetchData(2, province_id);
            districts.data.forEach((district) => {
              const option = document.createElement("option");
              option.value = district.full_name;
              option.textContent = district.full_name;
              option.setAttribute("data-district_id", district
                .id);
              districtSelect.appendChild(option);
            });
          } catch (error) {}
        }
      });
      // Load wards when a district is selected
      districtSelect.addEventListener("change", async () => {
        wardSelect.innerHTML =
          "<option disabled selected value=''>Chọn Phường/Xã</option>";
        const district_id = districtSelect
          .querySelector("option:checked")
          .getAttribute("data-district_id");
        const wards = await fetchData(3, district_id);
        wards.data.forEach((ward) => {
          const option = document.createElement("option");
          option.value = ward.full_name;
          option.textContent = ward.full_name;
          wardSelect.appendChild(option);
        });
      });
      // console.log(fetchData(1, 0));
    });
  </script>
  <script src="{{ asset('admin/trumbowyg/trumbowyg.min.js') }}"></script>
  <script>
    $('.description').trumbowyg({
      btns: [
        ['viewHTML'],
        ['undo', 'redo'],
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
      ]
    });
  </script>
@endsection
@endsection
