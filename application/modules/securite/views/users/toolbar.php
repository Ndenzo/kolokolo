<div class="right">
<form method="POST">
        <table class="pull-left">  
        <tr>
          <td class="control-label" style="vertical-align: middle;">&nbsp;Role&nbsp;</td>
          <td style="width: 150px;">
<?php dropDown('SELECT role_id,role_name FROM users_roles WHERE role_id!=1',array(
                    'name'=>'role_id',
			        'id'=>"role_id",
					'class'=>'select2-nosearch',
					'attr'=>'data-placeholder="choisir un role" data-rule-required="true"',
                    'blank'=>'-1|tous',
					'selected'=>@$this->session->filter['role_id']
          ));?>                  
          </td>
        </tr>
        </table>     
        <table class="pull-left">  
        <tr>
          <td class="control-label" style="vertical-align: middle;">&nbsp;Statut&nbsp;</td>
          <td style="width: 150px;">
<?php dropDown('SELECT statut_code,statut_name FROM users_status',array(
                    'name'=>'user_status',
			        'id'=>"user_status",
					'class'=>'select2-nosearch',
					'attr'=>'data-placeholder="choisir un statut" data-rule-required="true"',
                    'blank'=>'-1|tous',
					'selected'=>@$this->session->filter['user_status']
          ));?>                  
          </td>
        </tr>
        </table>  
</form>        
</div>           
    