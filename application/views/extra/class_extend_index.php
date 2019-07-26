<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">List Class Extend 
            <a href="<?=base_url('classextend/class_extend_create')?>" class="btn btn-space btn-primary pull-right">Request for class extend</a>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Teacher Name</th>
                  <th>Approved Teacher Name</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->teacher?></td>
                  <td><?=$value->app_teacher?></td>
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