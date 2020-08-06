<style>
	.w600{width:400px;}
	.fa-viber{font-size: 15px; color: hsl(286.9, 46%, 37.1%);}
	.fa-comment-dots{font-size: 16px; color: brown;}
	a.links{ color: hsl(213.6, 76.9%, 42.4%); }
</style>
<div class="card mb-4">
	<div class="card-header"><i class="fas fa-people-carry" style="color: hsl(200.4, 100%, 41%);"></i> <?=$title . ' / всего: ' .$total?></div>
	<div class="card-body" style="padding:0px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr style="background: 1px hsl(110.4, 100%, 95.1%);">
						<th>Имя</th>
						<th>Имя юзера</th>
						<th>Телефон</th>
						<th>Мэйл</th>
						<th>Коммент.</th>
						<th>act</th>
					</tr>
				</thead>
				<tbody>
<?php
foreach($installers as $installer){
	echo"<tr>"; 
	echo"<td>".$installer['name']."</td>";
	echo"<td>".$installer['username']."</td>";
	echo"<td>".$installer['phone']."</td>";
	echo"<td>".$installer['email']."</td>";
	echo"<td>".$installer['comment']."</td>";
	echo"<td style='text-align:center;'> <i style='color:red;' class=\"far fa-trash-alt\"></i> </td>";
	echo"</tr>"; 
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>

