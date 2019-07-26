<meta name=”viewport” content=”width=device-width″>
<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Update Profile<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open_multipart(base_url('dashboard/account'))?>
             
              <div class="form-group col-md-3">
                  <label>Name<span style="color:red;">*</span></label>
                   <?=form_input('name',$model->name,['class'=>'form-control input-sm','placeholder'=>'Enter teacher Name'])?>
              </div>
             <?php if($this->session->user_type==2): ?>
              <div class="form-group col-md-3">
                  <label>Registration No.<span style="color:red;">*</span></label>
                   <?=form_input('reg_no',$model->reg_no,['class'=>'form-control input-sm','placeholder'=>'Enter registration no','disabled'=>'true'])?>
              </div>
              <?php endif; ?>
               <div class="form-group col-md-3">
                <label>Email<span style="color:red;">*</span></label>
                <?=form_input('email',$model->email,['class'=>'form-control input-sm','placeholder'=>'Enter Email '])?>
              </div>
              <div class="form-group col-md-3">
                <label>Password<span style="color:red;">*</span></label>
                <?=form_input('password','',['class'=>'form-control input-sm','placeholder'=>'Enter Password '])?>
              </div>
              <?php if($this->session->user_type==2): ?>
              <div class="form-group col-md-3">
             <label>Choose Pictures</label>
              <?=form_upload('userfile','')?>
              </div><br>
              <div class="form-group col-md-12">
                  <label>Teacher Experience</label>
                   <?=form_textarea('bio',$model->bio,['class'=>'form-control input-sm','placeholder'=>'Enter Teacher Experience'])?>
              </div>
              <?php endif; ?>
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
                