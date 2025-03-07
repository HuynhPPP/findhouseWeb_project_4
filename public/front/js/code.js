$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
            Swal.fire({
            title: 'Bạn chắc chắn muốn xoá ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xoá',
            cancelButtonText: "Huỷ"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                'Xoá thành công !',
                'success'
                )
            }
        }) 
    });
});


//// Confirm ////

$(function(){
    $(document).on('click','#confirm',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
            Swal.fire({
            title: 'Are you sure?',
            text: "Confirm This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                'Confirm!',
                'Your file has been Confirm.',
                'success'
                )
            }
        }) 
    });
});
