<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
    
	<body>
		<h1>Upload de Arquivos.</h1>
		<form>
		  <div id="list"></div>
		  <br><br>
		  <input type="button" id="pick" value="Upload">
		  <br><br>
		  <div id="link"></div>
		</form>
		 
		<!-- (B) LOAD PLUPLOAD FROM CDN -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.5/plupload.full.min.js"></script>
		<script>
		// (C) INITIALIZE UPLOADER
		window.onload = () => {
		  // (C1) GET HTML FILE LIST
		  var list = document.getElementById("list");
		 
		  // (C2) INIT PLUPLOAD
		  var uploader = new plupload.Uploader({
			runtimes: "html5",
			browse_button: "pick",
			url: "upload.php",
			chunk_size: "10mb",
			init: {
			  PostInit: () => { list.innerHTML = "<div>Pronto</div>"; },
			  FilesAdded: (up, files) => {
				plupload.each(files, (file) => {
				  let row = document.createElement("div");
				  row.id = file.id;
				  row.innerHTML = `${file.name} (${plupload.formatSize(file.size)}) <strong></strong>`;
				  list.appendChild(row);
				});
				uploader.start();
			  },
			  UploadProgress: (up, file) => {
				document.querySelector(`#${file.id} strong`).innerHTML = `${file.percent}%`;
			  },
			  FileUploaded:  (up, file) => {
			    let nameFile = file['name'].replaceAll(/\s/g,'');
				let linkArquivo = `${location.protocol}//${location.host}/uploads/${nameFile}`;
			    document.querySelector("#link").innerHTML = `<a href=${linkArquivo}>${linkArquivo}</a>`;
			  }
			  ,
			  Error: (up, err) => console.error(err)
			}
		  });
		  uploader.init();
		};
		</script>
	</body>
	
</html>