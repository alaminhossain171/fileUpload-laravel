@extends('Layout.App')
@section('title','Home')


@section('content')
<div class="container d-flex mt-5">
    <div class="card text-center" >
        <div class="card-body">
          <h5 class="card-title">File submit axios</h5>
          <div class="form">
              <input id="fileInput" type="file" class="form-control m-3">
              
              <button id="submitBtn" onclick="onSubmit()" class="btn btn-primary btn-block">Submit</button>
          <h3 id="uploadPercentageId"></h3>
            </div>
        </div>
      </div>


      <table class="table w-75 p-5 mx-5">
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>

<tbody class="tableData">

</tbody>
      </table>

</div>
    
@endsection

@section('script')
<script>

function getFileList(){
  axios.get('/select')
  .then(function (response) {
   var jsondata=response.data;
$.each(jsondata,function(i){
  $('<tr>').html("<td>"
  +jsondata[i].id+
  "</td>"+"<td><a href='/download/"+jsondata[i].path+"' class='btn btn-success'>Download</a></td>").appendTo('.tableData');
})



  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .then(function () {
    // always executed
  });
// axios.get('/select').then(function(response){
//   var jsondata=response.data;
//   console.log(jsondata);
//   $.each(jsondata,function(i){
//     $('<tr>').html(
//       "<td>"+jsondata[i].id+"</td>"+"<td><button data-id="+jsondata[i].path+"class=btn dowloadBtn btn-primary">Download</button>
//     ).appendTo('.tableData');
//   })
// });


}
getFileList();


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
let uploaded=(progressEvent.loaded)/(1028*1028);
let total=(progressEvent.total)/(1028*1028);
let due=total-uploaded;
$('#uploadPercentageId').html('Total uploaded: '+uploaded.toFixed(2)+'MB'+' Total: '+total.toFixed(2)+'MB'+' Due :'+due.toFixed(2)+'MB');

  // $('#uploadPercentageId').html(UploadPercentage+'%')
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