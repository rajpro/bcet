<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">View Notice</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl.No</th>
                  <th>Notice Subject</th>
                  <th>Notice Content</th>
                   <th>Notice For</th>
                  <th>Notice Date</th>
                  <th>Status</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->notice_subject?></td>
                  <td><?=$value->notice_content?></td>
                  <td><?=$value->notice_for?></td>
                  <td><?=$value->notice_date?></td>
                  <td>
                    <?php
                      switch ($value->status) {
                        case 'active':
                          echo '<span class="badge badge-success">Active</span>';
                          break;
                        case 'deactive':
                          echo '<span class="badge badge-danger">Deactive</span>';
                          break;
                      }
                    ?>
                  </td>
                  <td class="actions">
                    <a href="<?=base_url('notice/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
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