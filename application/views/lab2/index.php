<div class="container">
<script type="text/javascript">
	function sort(el) {
		var col_sort = el.innerHTML;
		var tr = el.parentNode;
		var table = tr.parentNode;   
		var td, arrow, col_sort_num;
for (var i=0; (td = tr.getElementsByTagName("td").item(i)); i++) {
	if (td.innerHTML == col_sort) {
		col_sort_num = i;
		if (td.prevsort == "y"){
			arrow = td.firstChild;
			el.up = Number(!el.up);
			}else{
				td.prevsort = "y";
				arrow = td.insertBefore(document.createElement("span"),td.firstChild);
				el.up = 0;
				}
				arrow.innerHTML = el.up?"↑ ":"↓ ";
		}else{
			if (td.prevsort == "y"){
				td.prevsort = "n";
				if (td.firstChild) td.removeChild(td.firstChild);
			}
		}
} 
	var a = new Array();
	 
	for(i=1; i < table.rows.length; i++) {
		a[i-1] = new Array();
		a[i-1][0]=table.rows[i].getElementsByTagName("td").item(col_sort_num).innerHTML;
		a[i-1][1]=table.rows[i];
	} 
	a.sort();
	if(el.up) a.reverse(); 

	for(i=0; i < a.length; i++)
		table.appendChild(a[i][1]);
} 
</script>

<h3> Додади новий продукт </h3>
<form action="<?php echo URL . 'lab2/addItem'; ?>" method="post">
<table class="table table-bordered">

<tbody>
	<tr>
				<td> <input type="text" name="author" placeholder="Автор заявки"></td>
		<td> <input type="text" name="product" placeholder="Продукт"></td>
		<td> <input type="text" name="manufactor" placeholder="Виробник"></td>
		<td> <input type="number" name="quantity" placeholder="Кiлькiсть"></td>
		<td> <input type="text" name="description" placeholder="Додаткова iнформацiя"></td>
		<td> <button type="submit" class="btn btn-primary">Додати</button> </td>
	
	</tr>
</tbody>
</table>
</form>
<h3> Таблиця попиту </h3>
<table class="table table-bordered">
<thead>
<tr>
        <td onclick="sort(this)">#</td>
        <td onclick="sort(this)">Author</td>
        <td>Product</td>
        <td>Manufactor</td>
	<td onclick="sort(this)">Quantity</td>
	<td>Description</td>
	<td onclick="sort(this)">Demand</td>
        <td>Delete</td>
</tr>
</thead>
<tbody>
<?php foreach ($items as $item) {?>
    <tr>
        <td><?php if (isset($item->id)) echo $item->id; ?></td>
        <td><?php if (isset($item->author)) echo $item->author; ?></td>
        <td><?php if (isset($item->product)) echo $item->product; ?></td>
        <td><?php if (isset($item->manufactor)) echo $item->manufactor; ?></td>
        <td><?php if (isset($item->quantity)) echo $item->quantity; ?> </td>
        <td><?php if (isset($item->description)) echo $item->description; ?></td>
        <td><?php if (isset($item->demand)) echo $item->demand; ?></td>
        <td> <?php if (Session::get('canEdit')) { ?>
        	<form action="<?php echo URL . 'lab2/delete'; ?>" method="post">
        	<input type="hidden" name="delete" value="yes">
        	<input type="hidden" name="id" value="<?php echo $item->id; ?>">
			<button type="submit" class="btn btn-default">Delete</button>
        	</form>
        	<?php } ?>
        </td>
    </tr>
    <?php } ?>
</tbody>
</table>
</div>