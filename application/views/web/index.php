<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">Web Maintainence</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th width="100">Sl No.</th>
                  <th width="200">Content Type</th>
                  <th width="200">Title</th>
                  <th>Title Content</th>
                  <th>Pictures</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->con_type?></td>
                  <td><?=$value->title?></td>
                  <td><?=$value->content?></td>
                  <td><img src="<?=base_url('home_assets/images/'.$value->pic)?>" alt='no image' height="100" width="100"></td>
                  <td class="actions">
                    <a href="<?=base_url('web/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
                    
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