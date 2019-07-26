<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add Staff<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open(base_url('staff/create'))?>
              <div class="form-group col-md-3">
                <label>Role <span style="color:red;">*</span></label>
                <?=form_dropdown('role',$roles,set_value('role'),['class'=>'form-control input-sm'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Name <span style="color:red;">*</span></label>
                <?=form_input('name',set_value('name'),['class'=>'form-control input-sm','placeholder'=>'Enter staff Name'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Designation <span style="color:red;">*</span></label>
                <?=form_input('desgn',set_value('desgn'),['class'=>'form-control input-sm','placeholder'=>'Enter designation '])?>
              </div>
              <div class="form-group col-md-3">
                <label>Email <span style="color:red;">*</span></label>
                <?=form_input('email',set_value('email'),['class'=>'form-control input-sm','placeholder'=>'Enter Email'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Salary <span style="color:red;">*</span></label>
                <?=form_input('salary',set_value('salary'),['class'=>'form-control input-sm','placeholder'=>'Enter salary amount '])?>
              </div>
              <div class="form-group col-md-3">
                <label>Username <span style="color:red;">*</span></label>
                <?=form_input('username',set_value('username'),['class'=>'form-control input-sm','placeholder'=>'Enter Username'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Password <span style="color:red;">*</span></label>
                <?=form_input('password',set_value('password'),['class'=>'form-control input-sm','placeholder'=>'Enter Password'])?>
              </div>
              <div class="form-group col-md-3">
             <label>Choose Pictures</label>
            <?=form_upload('userfile','')?>
            <span class="small">Photos must be less than 1mb</span>
              </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                     <button class="btn btn-space btn-default">Cancel</button>
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
                