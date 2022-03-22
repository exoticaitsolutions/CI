
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"  crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"  crossorigin="anonymous"></script>

<script>
$(function(){
  if($(".attach").length){
    $(".attach").click(function(){
        $("#myModal").modal('show');
        $("#exampleInputTitle").val($(this).attr('data-name'))
        $("#product_id").val($(this).attr('data-id'))
    });

    $(".close").click(function(){
      $("#exampleInputPrice").val('')
      $("#exampleInputQyt").val('')
        $("#myModal").modal('hide');
    });

    $('#attach_form').on('submit', function (e) {

      e.preventDefault();
      var check = true;
      $("#attach_form input").each(function(index, item) {
        if($(item).val() == ''){
          check = false;
         $(item).next().text('This input field value is required.');
        }else{
          $(item).next().text('')
        }
      })
      if(check){
        $.ajax({
          type: 'post',
          url: '<?= base_url()?>attach_product',
          data: $('#attach_form').serialize(),
          success: function (res) {
            if(res.status){
              alert(res.message)
              $("#myModal").modal('hide');
            }else{
              alert(res.message)
            }
          }
        });
      }

    });


  }
})
</script>
</html>
</html>