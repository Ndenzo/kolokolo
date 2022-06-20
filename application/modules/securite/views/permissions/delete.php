<div class="portlet light bordered" style="margin: auto; width: 80%">
  <div class="portlet-title">
    <div class="caption"> <i class="fa fa-trash "></i> <span class="caption-subject  bold uppercase">Supprimer un enregistrement</span> </div>
    <div class="actions"></div>
  </div>
  <div class="portlet-body form">
    <form name="form" id="form" action="<?php _url('security/permissions/delete'); ?>" method="POST" role="form" class="form-horizontal">
      <div class="form-body" style="padding: 24px;">
        <div class="form-group">
            <div class="col-md-1" style="text-align: center;"><i class="fa fa-trash fa-5x"></i></div>
            <div class="pull-left">
              <p >&Ecirc;tes vous sur de vouloir supprimer l'enregistrement <strong></strong>
                la proc&eacute;dure est irr&eacute;versible, les donn&eacute;es seront perdues d&eacute;finitivement. </p>
            </div>
        </div>
      </div>
      <div class="form-actions right">
      <input name="permission_id" value="<?=$id?>" type="hidden" />
            <button type="submit" class="btn green">Enregistrer</button>
            <a href="<?php _url('/security/permissions');?>" class="btn default">Retour</a> 
      </div>
    </form>
  </div>
</div>
