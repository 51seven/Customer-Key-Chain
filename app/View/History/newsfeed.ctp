<h2>Newsfeed</h2>
<?php
echo "<br><br>";

if(isset($this->request->named['direction']) && $this->request->named['direction'] == "desc") {
	$direction = " ";
	$class = "glyphicon glyphicon-sort-by-alphabet";
}
else {
	$direction = " ";
	$class = "glyphicon glyphicon-sort-by-alphabet-alt";
}
echo "<p>";
echo $this->Paginator->sort('time', $direction, array('class' => $class));
echo " ";
echo $this->Paginator->counter('{:count}')." total Results - ";
echo $this->Paginator->counter('Page {:page} of {:pages}');
echo "</p>";

foreach ($histores as $key => $history) {
	echo "<section class='history'>";
		echo "<h3>";
			echo $this->Time->format($history['History']['time'], '%d.%m.%y');
			echo "<small>";
				echo $this->Time->format($history['History']['time'], ' %k:%M');
				echo " - ".$history['User']['username'];
			echo "</small>";
		echo "</h3>";

		echo "<p class='text'>".$history['History']['text']."</p>";

		echo "<span class='options'>";
			echo $this->Html->link('Bearbeiten', array(
				'controller' => 'history',
				'action' => 'edit', $history['History']['history_id']
			));
		echo " ";
		echo $this->Html->link('Löschen', array(
			'controller' => 'history',
			'action' => 'delete', $history['History']['history_id'],
			), array(), "Willst du diesen Eintrag wirklich entfernen?"
		);

		if(isset($history['History']['updated'])) {
			echo " ".$history['History']['updated'];
		}
	echo "</span>";
	echo "</section><hr>";
}

?>
<div class="pagination pagination-large">
    <ul class="pagination">
    <?php
	echo $this->Paginator->prev(__('« prev'), array(
		'tag' => 'li',
		'currentClass' => 'disabled',
		), null, array(
		'tag' => 'li',
		'class' => 'disabled',
		'disabledTag' => 'a'
	));
	echo $this->Paginator->numbers(array(
		'separator' => '',
		'currentTag' => 'a', 
		'currentClass' => 'active',
		'tag' => 'li',
		'first' => 1,
		'ellipsis' => '<li class="disabled"><a>...</a></li>',
	));
	echo $this->Paginator->next(__('next »'), array(
		'tag' => 'li',
		'currentClass' => 'disabled'
		), null, array(
		'tag' => 'li',
		'class' => 'disabled',
		'disabledTag' => 'a'
	));
    ?>
    </ul>
</div>