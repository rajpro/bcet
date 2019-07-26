<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">List  of Staff</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Staff Name</th>
                  <th>Designation</th>
                  <th>Status</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->name?></td>
                  <td><?=$value->desgn?></td>
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
                    <a href="<?=base_url('staff/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
                  </td>
                </tr>
                <?php endforeach;endif; ?>
              </tbody>
            </table>
          </div>
          <hr>
          <div style="margin:0px 30px;" class="pull-right">
            <ul class="pagination">
              <?=$this->pagination->create_links()?>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>