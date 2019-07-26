<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Student Filter<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('student/index'),['method'=>'get'])?>
              <div class="form-group col-md-3">            
               <label>Academic Year</label>
                <?=form_dropdown('acid',$academicyear,'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'aid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Course</label>
                <?=form_dropdown('course',$courses,'',['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Branch</label>
                <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
                </div>
              </div>
             <div class="form-group col-md-3">
                <label>Semester</label></label>
                 <div class="sem">
                <?=form_dropdown('semester',['Choose Semester'], '',['class'=>'form-control input-sm','placeholder'=>'Choose Semester','onchange'=>'findTeacher()','id'=>'sid'])?>
              </div>
            </div>
            <!-- section start -->
              <div class="form-group col-md-3">
                  <label>Section  <span style="color:red;">*</span></label>
                     <?=form_dropdown('section',['0'=>'Choose one','A'=>'A','B'=>'B'],'A',['class'=>'form-control input-sm'])?>
                </div> 

               <!-- section edn -->
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
          <div class="panel-heading">List of Students</div>
          <div class="col-xs-12">
            <p class="text-right">
            </form>
            </p>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>Registration No.</th>
                  <th>Roll No.</th>
                  <th>Student Phone No</th>
                  <th>Parent Phone No</th>
                  <th>Branch</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th class="actions" style="width:110px;"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;if(!empty($model)):foreach($model as $value): ?>
                <tr>
                  <td><?=$i++?></td>
                  <td><?=ucwords($value->name)?></td>
                  <td><?=$value->reg?></td>
                  <td><?=strtoupper($value->roll)?></td>
                  <td><?=$value->stu_phone?></td>
                  <td><?=$value->par_phone?></td>
                  <td><?=$branches[$value->branch]?></td>
                  <td><?=$value->address?></td>
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
                    <a href="<?=base_url('student/view/'.$value->id)?>" class="icon"><i class="mdi mdi-desktop-mac"></i></a>
                    <a href="<?=base_url('student/update/'.$value->id)?>" class="icon"><i class="mdi mdi-edit"></i></a>
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