@extends('layouts.app')
@section('content')
<!-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> -->
<script type="text/javascript" language="javascript" src="{{ URL::asset('ckeditor/ckeditor.js') }}" ></script>
<script type="text/javascript" language="javascript" src="{{ URL::asset('ckfinder/ckfinder.js') }}" ></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{url('post/create')}}" method="POST" role="form" enctype="multipart/form-data">
            {!! csrf_field() !!}
				<legend>Form title</legend>
				<div class="form-group">
					<label for="">Đăng bài viết</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Input title" onkeyup="ChangeToSlug();" required="">
                    <br>
                    <div style="margin-bottom: 20px;">
                     <img id="logo-img" onclick="document.getElementById('add-new-logo').click();" style="width: 250px; height: 250px; border-radius: 5px; border:solid 2px #A3B5F7;" src="{{ URL::asset('public/img/noimage.png') }}"/>
                     <input style="display: none;" type="file" enctype="multipart/form-data"  id="add-new-logo" name="file" accept="image/*" onchange="addNewLogo(this)"/>
                    </div>
                    <br>
                    <textarea id="content" name="content"></textarea>
                    <br>
					<input type="text" class="form-control" id="slug" name="slug" placeholder="Input slug" onkeyup="CheckSlug();">
                    <p id="thongbao" style="visibility:hidden">slug bị trùng</p>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
        </div>
    </div>
</div>
<script language="javascript">
    var data =<?php echo json_encode($slugs, JSON_FORCE_OBJECT) ?>;
    var size = Object.keys(data).length;
    function ChangeToSlug()
    {
        var title, slug, suggestSlug;
        var k = 1;
        //Lấy text từ thẻ input title 
        title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        for (i = 0; i < size; i++) { 
            if(slug == data[i]){
                document.getElementById("thongbao").style.visibility = 'visible';
                // suggestSlug = slug + "-" + k;
                //     for (j = 0; j < size; j++) {    
                //         if(suggestSlug == data[j]){
                //             k++;
                //             suggestSlug = slug + "-" + k;
                //         }
                //     }
                break;
            }else{
                document.getElementById("thongbao").style.visibility = 'hidden';
            }
            
        }
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
    function CheckSlug(){
        var suggestSlug;
        slug = document.getElementById("slug").value;
        for (i = 0; i < size; i++) { 
            if(slug == data[i]){
                document.getElementById("thongbao").style.visibility = 'visible';
                break;
            }else{
                document.getElementById("thongbao").style.visibility = 'hidden';
            }
            
        }
    }
</script>
<script>
    CKEDITOR.replace( 'content',{
        filebrowserBrowseUrl : '../ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '../ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : '../ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl      : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    
</script>
<script>
  var addNewLogo = function(input){
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              //Hiển thị ảnh vừa mới upload lên
              $('#logo-img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);     
      }
  }
  form.addEventListener('submit', function(e){
    e.preventDefault();
    var formdata = new Form
  });
  

</script>
@stop