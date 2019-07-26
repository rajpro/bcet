<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Request for a Leave<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open(base_url('teacherleave/teacher_leave_create'))?>
             <div class="form-group col-md-4">
                  <label>Leave Subject <span style="color:red;">*</span></label>
                  <?=form_input('leave_sub',set_value('leave_sub'),['class'=>'form-control input-sm','placeholder'=>'Enter the Leave Subject'])?>
              </div>
              <div class="form-group col-md-4">
                  <label>Date of Leave From<span style="color:red;">*</span></label>
                    <?=form_input('date_from',set_value('date_from'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Date of leave'])?>
              </div>
              <div class="form-group col-md-4">
                <label>Date of Leave To<span style="color:red;">*</span></label>
                  <?=form_input('date_to',set_value('date_to'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Date of leave'])?>
              </div>
              <div class="clearfix"></div>
              <div class="class-adjust">
                <?php if(!empty($class_extend)): ?>
                  <table class="table table-bordered">
                    <tr>
                      <th>Date</th>
                      <th>Adjust Detail</th>
                    </tr>
                  <?php foreach($class_extend as $key => $value): ?>
                    <tr>
                      <td>
                        <?=$key?><br>
                      </td>
                      <td>
                        <table class="table">
                          <tr>
                            <th>Branch</th>
                            <th width="150">Semester</th>
                            <th width="100">Time</th>
                            <th width="250">Teacher</th>
                          </tr>
                          <?php if(!empty($value)): ?>
                          <?php foreach($value as $val): ?>
                          <tr>
                            <input type="hidden" name="said[]" value="<?=$val['said']?>">
                            <input type="hidden" name="cxdate[]" value="<?=$key?>">
                            <td><?=$branches[$val['branch']]?></td>
                            <td><?=$semester[$val['semester']]?></td>
                            <td><?=$val['time']?></td>
                            <td>
                              <?=form_dropdown('ap_teach[]',$val['teachers'],'',['class'=>'form-control input-sm'])?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </table>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  </table>
                <?php endif; ?>
              </div>
              <div class="row xs-pt-15">
                <div class="col-xs-4"></div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <?php if(!empty($class_extend)): ?>
                    <button type="submit" class="btn btn-space btn-primary">Apply for Leave</button>
                    <a href="<?=base_url('teacherleave/teacher_leave_create')?>" class="btn btn-space btn-default">Reset</a>
                    <?php else: ?>
                    <button type="submit" class="btn btn-space btn-primary">Adjust Class</button>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
     </div>
    </div>
   </div>
 </div>