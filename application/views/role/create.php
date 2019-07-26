<?php 
  $mod=array("student","teacher","branch","subject","academic","course","test","mark","attendance","notice","timetable","semester","section","staff","role","extra","web");
  $rol=array("view","create","update");
?>
<div class="be-content">
  <div class="main-content container-fluid">
   <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Create Role<span class="panel-subtitle"></span></div>
          <div class="panel-body">
             <?=form_open(base_url('role/create'))?>
              <div class='col-md-12'>
                <table class="table table-bordered">
                <tr>
                  <div class="form-group col-md-3">
                  <label>Name</label>
                  <?=form_input('name',set_value('name'),['class'=>'form-control input-sm','placeholder'=>'Enter name'])?>
                </div>
                  <td>Modules</td>
                <?php foreach($rol as $value): ?>
                <th><?=$value?></th>
                <?php endforeach; ?>
                </tr>
                <?php foreach ($mod as $key => $val):?>
                 <tr>
                  <th>
                    <?=ucwords($val)?>
                  </th>
                  <?php for($i=0;$i<count($rol);$i++): ?>
                    <td>
                      <input type="checkbox" value="<?=$val.'_'.$rol[$i]?>" name="role[]">
                    </td>
                  <?php endfor; ?>
                </tr>
               <?php endforeach; ?>
                </table>
              </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4"></div>
                <div class="col-xs-12">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Add Role</button>
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