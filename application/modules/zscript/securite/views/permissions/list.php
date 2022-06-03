<?php include_once('help.php');?>
<?php show_notification();?>
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-dark"> <i class="icon-settings font-dark"></i> <span class="caption-subject bold uppercase">Liste des permissions</span> </div>        
      <div class="actions">

                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="fa fa-question"></i>
                                        </a>
                                    </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar" style="border: 1px solid #d4d4d4; padding: 4px;background: #efefef;">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <a href="<?php _url('security/permissions/showAdd/');?>" class="btn sbold blue"> Ajouter <i class="fa fa-plus"></i> </a>
              </div>
            </div>
            <div class="col-md-6">

            </div>
          </div>
        </div>
        <table id="datagrid" class="datagrid table table-striped table-bordered table-hover table-checkable">
          <thead>
            <tr>
              <th> <input type="checkbox" class="group-checkable" data-set=".datagrid .checkboxes" />
              </th>
              <th> Code </th>
              <th> Libell&eacute; </th>
              <th> Description </th>
              <th style="width: 1%;" class="no-sort"> Action </th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array(@$datagrid)):?>
          <?php foreach($datagrid as $rows):?>
            <tr>
              <td><input name="selected[]" type="checkbox" class="checkboxes" value="<?=$rows->permission_id?>" /></td>
              <td><?=$rows->permission_code?></td>
              <td><?=$rows->permission_name?></td>
              <td><?=$rows->permission_desc?></td>
              <td nowrap>
              <a href="<?php _url('security/permissions/showEdit/'.$rows->permission_id);?>" class="btn btn-icon-only green"><i class="fa fa-pencil"></i></a>
              <a href="<?php _url('security/permissions/showDetail/'.$rows->permission_id);?>" class="hide btn btn-icon-only purple"><i class="fa fa-tasks"></i></a>
              <a href="<?php _url('security/permissions/showDelete/'.$rows->permission_id);?>" class="btn btn-icon-only red"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET--> 
  </div>
</div>
