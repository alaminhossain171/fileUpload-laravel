@extends('Layout.App')
@section('title','Home')


@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mt-5 text-center" >
        <div class="card-body">
          <h5 class="card-title">File submit axios</h5>
          <div class="form">
              <input id="fileInput" type="file" class="form-control m-3">
              
              <button id="submitBtn" onclick="onSubmit()" class="btn btn-primary btn-block">Submit</button>
          <h3 id="uploadPercentageId"></h3>
            </div>
        </div>
      </div>

</div>
    
@endsection

@section('script')
<script>
   function onSubmit(){
      let file=document.getElementById('fileInput').files[0];
      let fileName=file.name;
     let fileSize=file.size;
    let fileType=fileName.split('.').pop();


    

let fileData=new FormData();
fileData.append('fileKey',file);
let config={headers:{'content-type':'multipart/form-data'},
onUploadProgress:function(progressEvent){
  let UploadPercentage=Math.round((progressEvent.loaded*100)/progressEvent.total)
  $('#uploadPercentageId').html(UploadPercentage+'%')
}
}
let url='/fileUp';
axios.post(url,fileData,config)
.then(function(response){
if(response.status==200){
  $('#uploadPercentageId').html('Upload Success');
  setTimeout(() => {
    $('#uploadPercentageId').html(" ");
  }, 2000);
}
else{
  $('#uploadPercentageId').html('Upload fail');
  setTimeout(() => {
    $('#uploadPercentageId').html(" ");
  }, 2000);
}

}).catch(function(error) {
  $('#uploadPercentageId').html('Upload fail');
  setTimeout(() => {
    $('#uploadPercentageId').html(" ");
  }, 2000);
  
})

   }
</script>
@endsection