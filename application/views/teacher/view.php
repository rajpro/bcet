<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">Teacher Details
                  
                </div>
                <div class="panel-body">
                  <table class="table table-condensed table-hover table-bordered table-striped">
                    <tbody>
                      <tr>
                        <td><b>Course</b></td>
                        <td><?=$course->name?></td>
                        <td><b>Branch</b></td>
                        <td><?=$branch->branch_name?></td>
                        <td><b>Name</b></td>
                        <td><?=ucwords($model->name)?></td>
                      </tr>
                        
                        <td><b>Registration No</b></td>
                        <td><?=$model->reg_no?></td>
                         <td><b>Date of joining</b></td>
                        <td><?=$model->d_o_joining?></td>
                        <td><b>Desgination</b></td>
                        <td><?=$model->designation?></td>
                      </tr>
                      <tr>
                         <td><b>salary</b></td>
                        <td><?=$model->salary?></td>
                        <td><b>Qualification</b></td>
                        <td><?=$model->qua?></td>
                        <td><b>Email</b></td>
                        <td><?=$model->email?></td>
                      </tr>
                       <tr>  
                        <td><b>Pictures</b></td>
                        <td><img src="<?=base_url('teacherimages/'.$model->pic)?>" height="42" width="42"></td>
                        <td><b>Teacher Experience</b></td>
                        <td><?=$model->bio?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>