<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">Notifications</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th width="150">Notification Date</th>
                  <th>Notification</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$value->not_date?></td>
                  <td>
                    <h4><?=$value->notice_subject?></h4>
                    <br>
                    <p><?=$value->notice_body?></p>
                  </td>
                </tr>
                <?php endforeach;endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>