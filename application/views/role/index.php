<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
<div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">List Role</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
               <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->name?></td>
                  <?php $r = json_decode($value->role); ?>
                  <td>
                  	<?php foreach($r as $v):$v= str_replace('_'," ",$v); ?>
                  		<?=ucwords($v)."<br>"?>
                  	<?php endforeach; ?>
                  </td>
                  <td class="actions">
                    <a href="<?=base_url('role/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
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