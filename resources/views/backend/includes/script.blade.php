
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"
  integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>

<script type="text/javascript">
    $(function () {
      $('.data-delete').on('click', function (e) {
        if(!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
      });
    });


    $(function () {
      $('#hide_succuss_message').on('click', function (e) {
        $(this).parent().remove();
      });
    });

    </script>
<script>
new WOW().init();
</script>
