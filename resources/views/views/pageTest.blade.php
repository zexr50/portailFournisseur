@extends('layouts.app')
    @section('title',"V3R Fournisseur Login")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageInscription.css') }}">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <!-- 
        Page pour tester des choses, faite pour tester des recherches dans les apis de Données Québec
    -->

    <form action="{{ route('testFiles') }}" method="POST" enctype="multipart/form-data" onsubmit="logToConsole()">
    @csrf
        <h1>Document</h1>
        <input type="file" id="fileInput" name="file[]" multiple>

        <ul id="fileList"></ul>

        <div id="bt-center">
            <button type="submit" class="button" id="bt_submit">Envoyer le formulaire</button>
        </div>
    </form>

    <script>
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        // Function to format file size
        function formatFileSize(size) {
            if (size < 1024) return size + ' bytes';
            else if (size < 1024 * 1024) return (size / 1024).toFixed(2) + ' KB';
            else return (size / (1024 * 1024)).toFixed(2) + ' MB';
        }

        // Update the file list when files are selected
        fileInput.addEventListener('change', function() {
            let totalSize = 0;
            //fileList.innerHTML = ''; // Clear the list for a fresh start

            Array.from(fileInput.files).forEach(file => {
                totalSize += file.size;

                const li = document.createElement('li');
                li.innerHTML = `${file.name} (${formatFileSize(file.size)})`;
                fileList.appendChild(li);
            });

            // Check total size limit
            if (totalSize > 70 * 1024 * 1024) { // 70 MB
                alert('Total file size exceeds 70 MB. Please select smaller files.');
                fileInput.value = ''; // Clear input if limit is exceeded
                fileList.innerHTML = ''; // Clear the file list
            }
        });
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function () {
            const selectedIdsLicences = Array.from(document.querySelectorAll('#selectedLicencesList li'))
                .map(item => item.getAttribute('data-id'));
            document.getElementById('licences_rbq_input').value = JSON.stringify(selectedIdsLicences);

            const selectedIdsCode = Array.from(document.querySelectorAll('#selectedCodeList li'))
                .map(item => item.getAttribute('data-id'));
            document.getElementById('code_input').value = JSON.stringify(selectedIdsCode);
        });
    </script>


    <script>
        function logToConsole() {
            console.log('boutton \'envoyer formulaire\' cliquer ');
        }
    </script>

   
@endsection