    </div>
    <script src="<?=base_url()?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/js/main.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/countup/countUp.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/chartjs/Chart.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/jquery.niftymodals/dist/jquery.niftymodals.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/js/custom.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        // function readnotification(){
        //     alert("working");
        //     $.post(base_url+"notification/readed",function(data, status){
        //         console.log(data);
        //     });
        // }
      	//initialize the javascript
        $.fn.niftyModal('setDefaults',{
            overlaySelector: '.modal-overlay',
            closeSelector: '.modal-close',
            classAddAfterOpen: 'modal-show',
          });
        
        App.init();
        $('.datepicker').datetimepicker({
            format: 'dd-mm-yyyy',
            startView: 'month',
            minView: 'month',
            autoclose: true
        });
         $('.datepicker_mark').datetimepicker({
            format: 'dd-mm-yyyy',
            startView: 'month',
            minView: 'month', 
           maxDate: new Date(new Date().setDate(new Date().getDate())),
            autoclose: true
        });
        $('.timepicker').datetimepicker({
            pickDate: false,
            format: 'HH:ii p',
            autoclose: true,
            pickerPosition: 'top-right',
            showMeridian: true,
            startView: 1,
            maxView: 1
        });

        $(".sparklinebasic1").sparkline("html", {
            height: "1.8em",
            width: "8em"
        });
        
        // for(var i=1;i<=8;i++){
        //     var ctx = document.getElementById("pie-chart"+i).getContext("2d");
        //     window.myPie = new Chart(ctx, {
        //         type: 'pie',
        //         data: {
        //             labels: ["No of Absent","No of Present"],
        //             datasets: [{
        //                 data: [40,80],
        //                 backgroundColor: ['#1367e6','#053e94'],
        //                 label: 'Dataset 1'
        //             }]
        //         },
        //         options: {responsive: true}
        //     });
        // }
      });
    </script>
  </body>
</html>