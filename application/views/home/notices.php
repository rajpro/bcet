  <!-- About Transportation -->
<section>
   
    <div class="container com-sp pad-bot-70">
        <div class="row">
            <div class="con-title">
                <h2><span>Notices</span></h2>
                <p></p>
            </div>
        </div>
         <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <tr>
                <th>Sl No.</th>
                <th>Notice Date</th>
                <th>Notice</th>
              </tr>
              <?php $i=1;if(!empty($notice_detail)):foreach($notice_detail as $value): ?>
              <tr>
                <td><?=$i++?></td>
                <td><?=$value->notice_date?></td>
                <td>
                  <?php if(!empty($value->file_name)): ?>
                  <h4><a href="<?=base_url('notice_files/'.$value->file_name)?>"><?=$value->notice_subject?></a></h4>
                  <?php else: ?>
                    <h4><a href="<?=base_url('notice_files/'.$value->file_name)?>"><?=$value->notice_subject?></a></h4>
                  <?php endif; ?>
                  <p><?=$value->notice_content?></p>
                </td>
              </tr>
            <?php endforeach;endif; ?>
            </table>            
          </div>            
        </div>
    </div>
</section>

   