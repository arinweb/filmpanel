<script>
  function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#imageOut").attr("src", reader.result);
      }
      reader.readAsDataURL(file);
    }
  }
</script>
<footer style="height:150px;display:flex;align-items:center;justify-content:center;">
<center>
<a target="_blank" style="text-decoration:none;padding:20px;display:block;border:2px solid #1249ff;border-radius:5px;color:#1249ff;" href="https://arinweb.epizy.com">PROGRAMMING ARİN WEB</a>
</center>
</footer>
</body>
</html>