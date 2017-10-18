<div class="text-center" id="img_contain">
  <img src="./images/no_image.jpg" id="blah" width="130" height="120" class="img img-responsive thumbnail">
</div>
<div class="form-group">
  <label class="control-label col-md-3">Upload Passport</label>
  <div class="col-md-7">
  <input type="file" name="passport" id="passport" class="demoInputBox form-control" required />
    <span id="passport-error" class="signup-error help-block"></span>
</div>
</div>
<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);

      $('#blah').hide();
      $('#blah').fadeIn(650);

    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#passport").change(function() {
  readURL(this);
});
</script>