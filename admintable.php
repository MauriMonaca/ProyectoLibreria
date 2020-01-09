<?php
session_start();
if (!isset($_SESSION['admin'])) {
 header("location: ./index.php");
} 
require('./include/header.php');
require_once('./include/connect.php');
?>
	<hr class="mt-0">
	<div class="container fluid  py-4 admin-layout px-lg-4">
		<div class="table-responsive-lg">
			<table class="table table-admin text-center" role="table">
    			<div class="d-flex justify-content-between mr-lg-2">
    				<h3>Lista de Libros</h3>
    				<p class="align-self-end">
    					<a href="uploadbook.php" title="Agregar Libro">
    						<i class="far fa-plus-square fa-2x text-success font-weight-bolder"></i>
    					</a>
    				</p>
    			</div>
				<?php
					if (isset($_SESSION['message_action']) && $_SESSION['message_action'])
					    {
					      printf("<div class='text-primary col-12'><b>%s</b></div>", $_SESSION['message_action']);
					      unset($_SESSION['message_action']);
					    }
				?>
  				<thead>
				    <tr>
				      <th scope="col">ID</th>	
				      <th scope="col">ISBN</th>
				      <th scope="col">Título</th>
				      <th scope="col">Autor</th>
				      <th scope="col">Editorial</th>
				      <th scope="col">Precio (ARS)</th>
				      <th scope="col">Stock</th>
				      <th scope="col">Modificar</th>
				      <th scope="col">Eliminar</th>
				    </tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * FROM libros ";
					$query = mysqli_query($link,$sql);
					while ($cell = mysqli_fetch_array($query)) {
					?>
				    <tr>
				      <td><?php echo $cell['id_libro'];  ?></td>
				      <td><?php echo $cell['isbn'];  ?></td>
				      <td class="titlebook"><?php echo $cell['nombre_libro']; ?></td>
				      <td><?php echo $cell['autor_libro'];  ?></td>
				      <td><?php echo $cell['editorial'];  ?></td>
				      <td><?php echo $cell['precio_libro'];  ?></td>
				      <td><?php echo $cell['stock_libro'];  ?></td>
				      <td>
				      	<p class="mb-0">
				      		<?php echo "<a href='./editbook.php?id=".$cell["id_libro"]."' title='Editar Libro'>";?>
				      			<i class="fas fa-pen text-primary"></i>
				      		</a>
				      	</p>
				      </td>
				      <td>
				      	<p class="mb-0">
				      		 <a href="#" title="Eliminar Libro">
				      			<i class="fa fa-trash-o text-dark" onclick="confirmDelete()" ></i>
									<script type="text/javascript">
									function confirmDelete(){
										var confirmar = confirm("¿ Realmente desea eliminar este registro ?");
										if (confirmar == true) {
											window.location = "<?php echo './actiondelete.php?id=' . $cell['id_libro'];?>";
										}
									} 
									</script>
				      		</div>
				      	</p>
				      </td>
				    </tr>
				    <?php }  ?>
			</table>
		</div>	 	
	</div>
<?php
require('./include/footer.php');
?>
