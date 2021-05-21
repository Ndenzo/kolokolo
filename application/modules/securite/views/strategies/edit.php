<div class="portlet light bordered">
  <div class="portlet-title">
    <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Modifier l'enregistrement</span> </div>
  </div>
  <div class="portlet-body form">
    <form action="<?php _url('/security/roles/update');?>" class="form-horizontal validate" role="form" method="POST">
      <div class="form-body">
        <div class="form-group">
          <label class="col-md-3 control-label">Code</label>
          <div class="col-md-9">
          <div class="input-icon right"> <i class="fa tooltips" data-original-title="OK!" data-container="body"></i>
            <input name="role_code" class="form-control" type="text" data-rule-required="true" data-msg-required="" value="<?=@$record->role_code;?>" />
          </div>          
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Libell&eacute;</label>
          <div class="col-md-9">
          <div class="input-icon right"> <i class="fa tooltips" data-original-title="OK!" data-container="body"></i>
            <input name="role_name" class="form-control" type="text" data-rule-required="true" data-msg-required="" value="<?=@$record->role_name;?>" />
          </div>          
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Description</label>
          <div class="col-md-9">
          <div class="input-icon right"> <i class="fa tooltips" data-original-title="OK!" data-container="body"></i>
            <input name="role_desc" class="form-control" type="text" data-rule-required="true" data-msg-required="" value="<?=@$record->role_desc;?>" />
          </div>          
          </div>
        </div>                
      </div>
      <div class="form-actions">
        <div class="row">
          <div class="col-md-offset-3 col-md-9">
          <input type="hidden" name="role_id" value="<?=@$record->role_id;?>" />
            <button type="submit" class="btn green">Enregistrer</button>
            <a href="<?php _url('/security/roles');?>" class="btn default">Retour</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
