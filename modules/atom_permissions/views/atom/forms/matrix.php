
		<div class="page-header"> 
            <h1 class="col-xs-12 col-sm-12 text-center text-left-sm"><a href="<?= MODULES_URL ?>permissions">Permissions</a> &nbsp; / &nbsp; Roles Matrix</h1> 
        </div>	
        
        <div class="panel">
	        <div class="panel-body">
				<table class="table table-hover">
				    <thead>
				        <tr>
				            <th>Permission</th>
				            <? foreach ($roles as $role) : ?>
				            <th class="text-center"><?= $role['name'] ?></th>
				            <? endforeach; ?>
				            
				        </tr>
				    </thead>
				    <tbody>
					    
				        <? foreach ($permissions as $permission): ?>
				        <tr>
				            <td class="matrix-title"><?=$permission['name']?></td>
				            
				            <? foreach($roles as $role): ?>
				            <td class="text-center">
					            <input type="checkbox" name="role_permissions[]" class="j-change_permission" value="" data-permission="<?=$permission['id']?>" data-role="<?=$role['id']?>" <?= (isset($roles_permissions[$role['id']]) && in_array($permission['id'], $roles_permissions[$role['id']])) ? 'checked="checked"' : '' ?> />
				            </td>
				            <? endforeach; ?>
				        </tr>
						<? endforeach; ?>
				    </tbody>
				</table>
	    	</div>
	    </div>
	    
	    
	    <script>
		    
		    $('.j-change_permission').on('change', function(){
			   
			   $.post('<?= MODULES_URL ?>atom_permissions/matrix_update', {permission: $(this).data('permission'), role: $(this).data('role'), status: $(this).prop('checked')});
			    
		    });
		    
		    
		</script>