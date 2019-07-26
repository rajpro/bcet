<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Teacher Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('teacher/index'),['method'=>'get'])?>
              <div class="form-group col-md-3">
                <label>Course</label>
                <?=form_dropdown('course',$course,'',['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch</label>
                <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Name</label>
                <?=form_input('name','',['class'=>'form-control input-sm','placeholder'=>'Search by name'])?>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Search</button>
                    <button class="btn btn-space btn-default">Cancel</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">List Teacher</div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Teacher Name</th>
                  <th>Teacher Regd No.</th>
                  <th>Branch</th>
                  <th>Join Date</th>
                  <th>Designation</th>
                  <th>Pictures</th>
                  <th>Status</th>
                  <th class="actions" width="150"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=$value->name?></td>
                  <td><?=$value->reg_no?></td>
                  <td><?=$branches[$value->branch]?></td>
                  <td><?=$value->d_o_joining?></td>
                  <td><?=$value->designation?></td>
                  <td><img src="<?=base_url('teacherimages/'.$value->pic)?>" height="42" width="42"></td>
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
                  <td  class="actions">
                    <a href="<?=base_url('teacher/view/'.$value->id)?>" class="icon"><i class="mdi mdi-desktop-mac"></i></a>
                    <a href="<?=base_url('teacher/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
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