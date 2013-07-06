<div class="well">
			<?php
			$tabla=listarDatosPorId("empleado",$_SESSION["id_usuario"]);
			foreach ($tabla as $item) { ?>
				<img class="thumbnail" src="<?php print $item["foto"];?>" alt="<?php print $item["usuario"];?>"/>
				<h3><?php print $item["usuario"];?></h3>
				<small>Usuario desde <?php print date('d/m/Y',$item["f_creacion"]); ?> - <strong><?php print ucwords($item["nombre"]); ?></strong></small>
				<p><?php print $item["email"];?></p>
				<a href="app_admin.php?accion=editar&id=<?php print $_SESSION["id_usuario"];?>">Editar Perfil</a> | <a href="cerrar_sesion.php">Logout</a>
			<?php	
			}
			?>
				</div>