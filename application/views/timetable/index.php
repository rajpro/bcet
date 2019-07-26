<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Timetable Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('timetable/index'))?>
              <div class="form-group col-md-3">
                <label>Academic Year <span style="color:red;">*</span></label>
               <?=form_dropdown('acid',$academicyear,(!empty($post['acid'])?$post['acid']:''),['class'=>' form-control input-sm','placeholder'=>'select any one'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course <span style="color:red;">*</span></label>
                 <?=form_dropdown('course',$courses,'',['class'=>' form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch <span style="color:red;">*</span></label>
                <div class="brn">
                  <?=form_dropdown('branch',['Choose Branch'],'',['class'=>' form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
              <div class="form-group col-md-3">
                <label>Section <span style="color:red;">*</span></label>
                <div>
                  <?=form_dropdown('sec',['1'=>'A', '2'=>'B'],'',['class'=>' form-control input-sm','placeholder'=>'select any one'])?>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-3">
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
    </div>
    <?php $days=array("monday","tuesday","wednesday","thursday","friday","saturday"); ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">Time Table
            <?php if(!empty($p_data)):?>
              <?php if($timetable[0]->status=='active'): ?>
              <a class="btn btn-danger btn-xs pull-right" href="<?=base_url('timetable/semester_update/'.$p_data['acid'].'/'.$p_data['course'].'/'.$p_data['branch'])?>">Deactivate</a>
              <?php else: ?>
              <a class="btn btn-success btn-xs pull-right" href="<?=base_url('timetable/semester_update/'.$p_data['acid'].'/'.$p_data['course'].'/'.$p_data['branch'])?>">Active</a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Days</th>
                  <?php if(!empty($timetable)): foreach ($timetable as $value):?>
                    <th><?=date("h a",strtotime($value->time_from))?>-<?=date("h a",strtotime($value->time_to))?></th>
                  <?php endforeach;endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($days as $dy): ?>
                <tr>
                  <td><?=strtoupper($dy)?></td>
                  <?php if(!empty($timetable_data)):foreach($timetable_data[strtoupper($dy)] as $val): ?>
                  <td><?=$subject[$val]?></td>
                  <?php endforeach;endif; ?>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
