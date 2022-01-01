<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Contacts-ShyamSarkar</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body onload="show_record()">
   <div class="container-fluid">
      <div class="row">
         <h1 class="h1">MyContacts-SPA</h1>
      </div>
   </div>

   <div class="container">
      <div class="row">
         <div class="col-lg-4 border py-5">
            <form class="row g-3" action="#" id="contact_form">
               <div class="mb-3">
                  <label for="username" class="form-label">Name</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Name">
               </div>
               <div class="mb-3">
                  <label for="mobile" class="form-label">Mobile</label>
                  <input type="text" class="form-control" name="mobile" id="mobile" maxlength="10" placeholder="Enter Mobile Number">
               </div>
               <div class="mb-3">
                  <label for="imgname" class="form-label">Upload Image</label>
                  <input class="form-control form-control-sm" name="imgname" id="imgname" type="file">
               </div>
               <div class="mb-3">
                  <input type="hidden" name="contact_id" id="contact_id" value="0">
                  <button type="submit" class="btn btn-success" name="submit" id="submit">Save</button>
                  <input type="reset" class="btn btn-secondary" value="Reset">
               </div>
            </form>
         </div>
         <div class="col-lg-8 border">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>Sno.</th>
                     <th>Name</th>
                     <th>Mobile</th>
                     <th>Image</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody id="tbl_data">

               </tbody>
            </table>
         </div>
      </div>
   </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   const myform = document.getElementById('contact_form');
   myform.addEventListener("submit", (e) => {
      e.preventDefault();
      var username = document.getElementById('username');
      var mobile = document.getElementById('mobile');
      var imgname = document.getElementById('imgname');
      if (username.value.trim() == "") {
         username.focus();
         return false;
      }
      if (mobile.value.trim() == "") {
         mobile.focus();
         return false;
      }
      const formData = new FormData(myform);
      const fileField = document.getElementById('imgname');
      formData.append('imgname', fileField.files[0]);
      fetch("save_data.php", {
            method: 'POST',
            body: formData
         })
         .then(res => res.text())
         .then(data => {
            console.log(data);
            show_record();
            if (data.trim() == 1) {
               swal("Record Saved Successfully!");
            } else {
               swal("Something went wrong!");
            }
            username.value = "";
            mobile.value = "";
            document.getElementById('contact_id').value = 0; // for insert condition
            imgname.value = "";

         })
         .catch(error => {
            console.log(error)
         })
   });
</script>
<script>
   function show_record() {
      fetch("show_record.php").then(resp => resp.text()).then((data) => {
         document.getElementById('tbl_data').innerHTML = data;
      });
   }
</script>
<script>
   function delete_data(id) {
      if (confirm("Are you sure?")) {
         const data = {
            'id': id
         };
         fetch("delete_data.php", {
               method: 'POST',
               body: "id=" + id,
               headers: {
                  "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
               },
            })
            .then(res => res.text())
            .then(data => {
               show_record();
               if (data.trim() == 1) {
                  swal("Record Deleted Successfully!");
               } else {
                  swal("Something went wrong!");
               }
            })
            .catch(error => {
               console.log(error)
            })
      }
   }
</script>

</html>