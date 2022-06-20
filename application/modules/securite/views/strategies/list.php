<?php include_once('help.php');?>
<?php show_notification();?>
<div class="row">
  <div class="col-md-12"> 
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-dark"> <i class="fa fa-shield font-dark"></i> <span class="caption-subject bold uppercase">Strat&eacute;gies de s&eacute;curit&eacute;</span> </div>
        <div class="actions"> <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"> <i class="fa fa-question"></i> </a> </div>
      </div>
      <div class="portlet-body">
        <form  method="POST" action="<?php _url('security/strategies/save/');?>">
          <div class="table-toolbar" style="border: 1px solid #d4d4d4; padding: 4px;background: #efefef;">
            <div class="row">
              <div class="col-md-6">
                <div class="btn-group">
                  <button type="submit" class="btn sbold blue"> Enregister <i class="fa fa-save"></i> </button>
                </div>
              </div>
              <div class="col-md-6"> </div>
            </div>
          </div>
          <?php foreach($roles as $r):?>
          <h4 class="block bold font-dark"><?=$r->role_name?></h4>
          <table id="datagrid" class=" table table-striped table-bordered table-hover table-checkable">
            <thead>
              <tr>
                  <th style="width: 1%"> # </th>
                  <th class="text-left"> Controleur </th>
                <th class="text-center"> Afficher </th>
                <th class="text-center"> Lister </th>
                <th class="text-center"> Ajouter </th>
                <th class="text-center"> Modifier </th>
                <th class="text-center"> Supprimer </th>                
                <th class="text-center"> Imprimer </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($permissions as $p):?>
              <tr>
                  <td title="cocher la ligne"><input type="checkbox" class="checkRow" /></td>
                  <td class="text-left"><?=$p->permission_name?></td>
                <td class="text-center"><input name="selected[<?=$r->role_id?>][<?=$p->permission_id?>][can_view]" type="checkbox" class="checkboxes" value="1" <?php strategie_checked($strategies,$r->role_id,$p->permission_id,'can_view');?> /></td>
                <td class="text-center"><input name="selected[<?=$r->role_id?>][<?=$p->permission_id?>][can_read]" type="checkbox" class="checkboxes" value="1" <?php strategie_checked($strategies,$r->role_id,$p->permission_id,'can_read');?> /></td>
                <td class="text-center"><input name="selected[<?=$r->role_id?>][<?=$p->permission_id?>][can_create]" type="checkbox" class="checkboxes" value="1" <?php strategie_checked($strategies,$r->role_id,$p->permission_id,'can_create');?> /></td>
                <td class="text-center"><input name="selected[<?=$r->role_id?>][<?=$p->permission_id?>][can_update]" type="checkbox" class="checkboxes" value="1" <?php strategie_checked($strategies,$r->role_id,$p->permission_id,'can_update');?> /></td>
                <td class="text-center"><input name="selected[<?=$r->role_id?>][<?=$p->permission_id?>][can_delete]" type="checkbox" class="checkboxes" value="1" <?php strategie_checked($strategies,$r->role_id,$p->permission_id,'can_delete');?> /></td>
                <td class="text-center"><input name="selected[<?=$r->role_id?>][<?=$p->permission_id?>][can_print]" type="checkbox" class="checkboxes" value="1" <?php strategie_checked($strategies,$r->role_id,$p->permission_id,'can_print');?> /></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <?php endforeach;?>
        </form>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET--> 
  </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.checkRow').on('click',function(){
            var checkBoxes = $(this).parents('tr:eq(0)').find('.checkboxes');
            checkBoxes.prop("checked", $(this).prop("checked"));
        });
    });
</script>