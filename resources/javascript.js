document.addEventListener('DOMContentLoaded', function() {

	// JS for upload users button
	var selectedFile = document.getElementById('usersUpload');
	if(selectedFile) {
		selectedFile.addEventListener('change', function(e){
			var fileName = '';			
			fileName = e.target.value.split( '\\' ).pop();
			
			if(fileName) {
				var label = document.getElementById('usersFileName');
				label.innerHTML = fileName;
			}
		});
	}
	
	// JS for upload lecturers and subjects button
	var selectedFile = document.getElementById('subjectsUpload');
	if(selectedFile) {
		selectedFile.addEventListener('change', function(e){
			var fileName = '';			
			fileName = e.target.value.split( '\\' ).pop();
			
			if(fileName) {
				var label = document.getElementById('subjectsFileName');
				label.innerHTML = fileName;
			}
		});
	}

	// JS for upload students and their subjects button
	var selectedFile = document.getElementById('studentsSubjectsUpload');
	if(selectedFile) {
		selectedFile.addEventListener('change', function(e){
			var fileName = '';			
			fileName = e.target.value.split( '\\' ).pop();
			
			if(fileName) {
				var label = document.getElementById('studentsSubjectsFileName');
				label.innerHTML = fileName;
			}
		});
	}
	
	var eventType = document.getElementById('eventType');
	eventType.addEventListener('change', function(e){
		var type = eventType.options[eventType.selectedIndex].value;
		if(type == 'lecture'){
			endDate = document.getElementById("endDate"); 
			endDate.disabled = false;
		} else {
			endDate.disabled = true;
		}
	});
});