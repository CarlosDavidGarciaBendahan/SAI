


function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(.xlsx)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Por favor agregue archivo con la extension .xlsx unicamente.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            /*reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img class="col-sm-6" src="'+e.target.result+'"/>';
            };*/
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}