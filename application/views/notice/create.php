<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Notice<span class="panel-subtitle"></span></div>
          <div class="panel-body">
           <?=form_open_multipart(base_url('notice/create'))?>
            
                 <div class="form-group col-md-3">
                  <label>Notice Subject</label>
                 <?=form_input('notice_subject',set_value('notice_subject'),['class'=>'form-control input-sm','placeholder'=>'Enter Notice Subject'])?>
                </div>
                 <div class="form-group col-md-3">
                  <label>Notice Content</label>
                  <input type="file" name="file_name" style="">
                  <span>or</span>
                  <?=form_textarea('notice_content',set_value('notice_content'),['class'=>'form-control input-sm','placeholder'=>'Enter Notice Content'])?>
                </div>
                 <div class="form-group col-md-3">
                  <label>Notice Date</label>
                 <?=form_input('notice_date',set_value('notice_date'),['class'=>'form-control input-sm datepicker','placeholder'=>'Enter Notice date'])?>
                </div>    
                 
                    
                  <div class="form-group col-md-3">
                  <label>Notice for  <span style="color:red;">*</span></label>
                     <?=form_dropdown('notice_for',['Allteachers&Website'=>'Allteachers&Website','AllTeachers'=>'AllTeachers','Website'=>'Website'],set_value('notice_for'),['class'=>'form-control input-sm'])?>
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
                