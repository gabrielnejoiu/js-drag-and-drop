<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Axaj 1 - Text File</title>
	
	<style>
		.area {
			background: #efefef;
			border: 1px solid gray;
			margin: 15px;
			min-height: 20px;
			padding: 15px;
			width: 250px;
		}
		
		.hovered {
			background: lightcyan;
			border-color: forestgreen;
		}
		
		#areas {
			display: flex;
		}
	</style>

</head>
<body>
<div id="areas">
	<div id="drag_area" class="area">
		<button id="button1" class="button">Button 1</button>
		<button id="button2" class="button">Button 2</button>
		<button id="button3" class="button">Button 3</button>
	</div>
	
	<div id="drop_area" class="area"></div>
</div>

<script>
	const Button = document.getElementsByClassName('button');
	const DragArea = document.getElementById('drag_area');
	const DropArea = document.getElementById('drop_area');

	function areaStyleHover(e) {
		e.preventDefault();
		e.target.classList.add("hovered");
	}

	function areaStyleLeave(e) {
		e.target.classList.remove("hovered");
	}

	function dragging(e) {
		e.preventDefault();
		window.localStorage.setItem('button', e.target.id);
	}

	function deleteFromStorage() {
		window.localStorage.removeItem('button');
	}

	function elementDropped(e) {
		e.preventDefault();
		const droppedElement = window.localStorage.getItem('button', e.target.id);
		let DropElem = e.target.classList.contains('.area') ? e.target : e.target.closest('.area');
		DropElem.append(document.getElementById(droppedElement));
		console.log(DropElem);
		deleteFromStorage();
		DragArea.classList.remove('hovered');
		DropArea.classList.remove('hovered');
	}

	// Create event listener.
	for (const DraggableButton of Button) {
		DraggableButton.draggable = true;
		DraggableButton.addEventListener('dragend', dragging);
	}

	DropArea.addEventListener('dragover', areaStyleHover);
	DropArea.addEventListener('dragleave', areaStyleLeave);
	DropArea.addEventListener('drop', elementDropped);

	DragArea.addEventListener('dragover', areaStyleHover);
	DragArea.addEventListener('dragleave', areaStyleLeave);
	DragArea.addEventListener('drop', elementDropped);

</script>

</body>
</html>
