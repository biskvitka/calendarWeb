document.addEventListener('DOMContentLoaded', function() {

	// JS for upload users button
	var selectedFile = document.getElementById('usersUpload');
	if(usersUpload) {
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
	if(usersUpload) {
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
	if(usersUpload) {
		selectedFile.addEventListener('change', function(e){
			var fileName = '';			
			fileName = e.target.value.split( '\\' ).pop();
			
			if(fileName) {
				var label = document.getElementById('studentsSubjectsFileName');
				label.innerHTML = fileName;
			}
		});
	}
});