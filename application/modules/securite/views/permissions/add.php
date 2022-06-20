<div class="portlet light bordered">
  <div class="portlet-title">
    <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Ajouter un enregistrement</span> </div>
  </div>
  <div class="portlet-body form">
    <form action="<?php _url('/security/permissions/insert');?>" class="form-horizontal validate" role="form" method="POST">
      <div class="form-body">
        <div class="form-group">
          <label class="col-md-3 control-label">Code</label>
          <div class="col-md-9">
          <div class="input-icon right"> <i class="fa tooltips" data-original-title="OK!" data-container="body"></i>
            <input name="permission_code" class="form-control" type="text" data-rule-required="true" data-msg-required="" />
          </div>          
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Libell&eacute;</label>
          <div class="col-md-9">
          <div class="input-icon right"> <i class="fa tooltips" data-original-title="OK!" data-container="body"></i>
            <input name="permission_name" class="form-control" type="text" data-rule-required="true" data-msg-required="" />
          </div>          
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Description</label>
          <div class="col-md-9">
          <div class="input-icon right"> <i class="fa tooltips" data-original-title="OK!" data-container="body"></i>
            <input name="permission_desc" class="form-control" type="text" data-rule-required="true" data-msg-required="" />
          </div>          
          </div>
        </div>                
      </div>
      <div class="form-actions">
        <div class="row">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">Enregistrer</button>
            <a href="<?php _url('/security/permissions');?>" class="btn default">Retour</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
