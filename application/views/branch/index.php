<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">List Branches</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Branch Name</th>
                  <th>Branch Code</th>
                  <th>Status</th>
                  <th>Pic</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->branch_name?></td>
                  <td><?=$value->code?></td>
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
                  <td><img src="<?=base_url('home_assets/images/'.$value->pic)?>" alt='no image' height="42" width="42"></td>
                  <td class="actions">
                    <a href="<?=base_url('branch/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
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