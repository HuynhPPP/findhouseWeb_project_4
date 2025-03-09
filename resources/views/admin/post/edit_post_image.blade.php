@extends('admin.master')
@section('customCss')
  <link rel="stylesheet" href="{{ asset('admin/css/post_image.css') }}">
  <!-- dropzone -->
  <link rel="stylesheet" href="{{ asset('admin/dropzone/min/dropzone.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dropzone/custom.css') }}">
@endsection
@section('content')
  <div class="pcoded-content">
    <div class="pcoded-inner-content">
      <!-- DOM/Jquery table start -->
      <div class="card">
        <div class="card-header">
          <h5>Cập nhật ảnh tin</h5>
        </div>
        <div class="text-center card-block">
          <form method="POST" action="{{ route('admin.update.image.post') }}"
            class="col-12 dropzone">
            @csrf
            <input type="hidden" name="post_id" value="{{ request('post_id') }}">
          </form>
          <button type="submit" class="mt-3 btn btn-primary"
            id="uploadImagePostBtn">Cập nhật</button>
        </div>
        <div class=" card-block">
          <div class="g-2 row" id="post_image">
          </div>
        </div>
      </div>
      <!-- DOM/Jquery table end -->
    </div>
  </div>
@endsection
@section('customJs')
  <script src="{{ asset('admin/dropzone/min/dropzone.min.js') }}"></script>
  <script>
    Dropzone.autoDiscover = false
    let myDropzone = new Dropzone('.dropzone', {
      uploadMultiple: true,
      autoProcessQueue: false,
      acceptedFiles: "image/*",
      dictDefaultMessage: "Nhấp để chọn ảnh hoặc kéo thả vào đây!",
      addRemoveLinks: true,
      parallelUploads: 1,
      maxFiles: 5,
      dictMaxFilesExceeded: "Bạn chỉ được tải lên tối đa 5 ảnh!",
      dictInvalidFileType: "Vui lòng chọn file đúng định dạng ảnh!.",
      init: function() {
        thisDz = this
        let uploadBtn = document.getElementById('uploadImagePostBtn')
        uploadBtn.addEventListener('click', function() {
          let nFiles = myDropzone.getQueuedFiles().length;
          if (nFiles > 0) {
            thisDz.options.parallelUploads = nFiles;
            thisDz.processQueue();
            toastr.success("Thêm thành công!")
          } else {
            toastr.error("Vui lòng chọn ảnh!")
          }
        })
        thisDz.on('queuecomplete', function() {
          this.removeAllFiles();
          getPostImages();
        });
      }
    });
    getPostImages();

    function getPostImages() {
      let url =
        "{{ route('admin.get.post.images', ['post_id' => request('post_id')]) }}";
      $.get(url, {}, function(response) {
        $('div#post_image').html(response.data)
      }, 'json')
    }
    $(document).on('click', '#deletePostImageBtn', function(e) {
      e.preventDefault();
      let url =
        "{{ route('admin.delete.post.image') }}";
      let token = "{{ csrf_token() }}";
      let image_id = $(this).data("image");
      Swal.fire({
        title: "Bạn có muốn xóa không?",
        text: "Bạn sẽ không thể khôi phục lại!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Hủy bỏ",
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.isConfirmed) {
          $.post(url, {
            _token: token,
            image_id: image_id
          }, function(response) {
            if (response.status == 1) {
              getPostImages();
              toastr.success(response.msg)
            } else {
              toastr.error(response.msg)
            }
          }, 'json')
        }
      });
    })
  </script>
@endsection
